<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Otp\VerifyOtpRequest;
use App\Notifications\SendSmsNotification;
use App\Service\MikrotikService;
use App\Service\UserService;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Traits\MustVerifyContact;
use App\Traits\VerifyByOtp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use Notifiable, VerifyByOtp, MustVerifyContact;

    /**
     * @var UserService
     */
    protected UserService $service;
    protected MikrotikService $mikrotikService;

    /**
     * @param UserService $user
     * @param MikrotikService $mikrotikService
     */
    public function __construct(UserService $user, MikrotikService $mikrotikService)
    {
        $this->service = $user;
        $this->mikrotikService = $mikrotikService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('Auth.login');
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $phone = $request->post('phone');
        $user = $this->service->firstOrCreate(['phone' => $request->post('phone')]);
        if (!Cache::has($phone) && $user->status != "disable") {
            $this->sendOtpVerification($phone);
            if (is_null($user->password))
                $this->service->updateAndFetch($user->id, ["password" => bcrypt($request->post('phone'))]);
            return redirect()
                ->route('otp-page', ["phone" => $phone])
                ->with('success', 'کد اعتبارسنجی با موفقیت اضافه شد.');
        }
        return back()->withErrors([
            'phone' => 'شماره موبایل وارد شده معتبر نمی باشد',
        ]);
    }

    /**
     * @return View|Factory|Application
     */
    public function createOtp(): View|Factory|Application
    {
        return view('Auth.otp');
    }

    /**
     * @throws Exception
     */
    public function otp(VerifyOtpRequest $request): RedirectResponse
    {
        try {
            $verifyOtp = $this->verifyOtp($request);
            $inputs = $request->only(['phone']);
            if ($verifyOtp["status"]) {
                if (!$verifyOtp["user"]->has_verified) {
                    $inputs["username"] = $request->validated('phone');
                    $inputs["password"] = bcrypt($request->validated('phone'));
                    $inputs["phone_verified_at"] = Carbon::now();
                    $inputs["traffic_limit"] = config('constants.traffic_limit_default');
                    $inputs["has_verified"] = true;
                }
                $macAddress = $this->mikrotikService->getUserMACByIP($request->ip());
                $macAddressRelation = null;
                $ipAddressRelation = null;
                if ($macAddress != null) {
                    if ($this->service->isMacAddressExists($verifyOtp["user"]->id, $macAddress))
                        $macAddressRelation["mac_address"] = $macAddress;
                }
                if ($this->service->isIpAddressExists($verifyOtp["user"]->id, $request->ip()))
                    $ipAddressRelation["ip_address"] = $macAddress;
                $this->mikrotikService->addAddressList($request->ip(), $request->validated('phone'));
                $this->mikrotikService->addNatRule($request->validated('phone'));
                $this->service->updateAndFetchWithRelation($verifyOtp["user"]->id, $inputs, $macAddressRelation, $ipAddressRelation);
                $this->notify(new SendSmsNotification(1, 9363634297));

                return redirect()->route('user-dashboard', ['id' => $verifyOtp["user"]->id])->with('success', 'اینترنت شما وصل شد.');
            }
            return redirect()->route('otp-page')->withErrors(['otp' => 'کد موقت شما صحیح نمی باشد.']);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }


    /**
     * @return View|Factory|Application
     * @throws Exception
     */
    public function dashboard(int $id): View|Factory|Application
    {
        try {
            $user = $this->service->show($id);
            return view('Auth.dashboard', compact('user'));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     * @throws Exception
     */
    public function logout(Request $request): Application|Redirector|RedirectResponse
    {
        try {
            if ($this->mikrotikService->removeNatRule($request->ip(), $request->user()->phone) && $this->mikrotikService->removeAddressList($request->ip(), $request->user()->phone)) {
                Cookie::forget('remember_token');
                Auth::logout();
                return redirect('/')->with('message', 'خروج با موفقیت انجام شد.');
            }
            return redirect()->route('user-dashboard', ['id' => $request->user()->id])->withErrors(['logout' => 'خروج شما موفقیت آمیز نبود.']);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function getData(): array
    {
        return $this->mikrotikService->getData();
    }
}

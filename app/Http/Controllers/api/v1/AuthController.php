<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Otp\VerifyOtpRequest;
use App\Service\MikrotikService;
use App\Service\UserService;
use App\Traits\SendMailTrait;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Traits\MustVerifyContact;
use App\Traits\VerifyByOtp;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    use Notifiable, SendMailTrait, VerifyByOtp, MustVerifyContact;

    /**
     * @var UserService
     */
    protected UserService $service;
//    protected MikrotikService $mikrotikService;

    /**
     * @param UserService $user
     * //     * @param MikrotikService $mikrotikService
     */
    public function __construct(UserService $user)
    {
        $this->service = $user;
//        $this->mikrotikService = $mikrotikService;
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
        if (!Cache::has($phone)) {
            $otp = $this->sendOtpVerification($phone);
            return redirect()
                ->route('otp-page', ['otp' => $otp, "phone" => $phone])
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
            if ($verifyOtp["status"]) {
                $inputs = $request->only(['phone']);
                $inputs["username"] = $request->validated('phone');
                $inputs["password"] = bcrypt($request->validated('phone'));
                $inputs["phone_verified_at"] = Carbon::now();
                $inputs["traffic_limit"] = config('constants.traffic_limit_default');
//                $this->mikrotikService->addUser($request->validated('phone'), bcrypt($request->validated('phone')));
                $user = $this->service->updateAndFetch($verifyOtp["user"]->id, $inputs);
                return redirect()->route('user-dashboard', ['id' => $user->id])->with('success', 'اینترنت شما وصل شد.');
            }
            return redirect()->route('otp-page')->withErrors(['otp' => 'کد موقت شما صحیح نمی باشد.']);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }


    /**
     * @param int $id
     * @return Container|mixed|object
     * @throws Exception
     */
    public function dashboard(int $id): mixed
    {
        try {
            $user = $this->service->show($id);
//            $traffic = $this->mikrotikService->getUserTraffic($user->phone);
            $traffic = [
                'bytes_in' => 0,  // Downloaded bytes
                'bytes_out' => 0, // Uploaded bytes
            ];
            return view('Auth.dashboard', compact('traffic', 'user'));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

//    public function createAdmin()
//    {
//        $admin = $this->service->create([
//            'phone' => "09381933579",
//            'username' => "09381933579",
//            'password' => bcrypt("09381933579"),
//            'name' => "آقای اسدی",
//            'is_vip' => true,
//            'is_admin' => true,
//        ]);
//        return response()->json([
//            'message' => 'Admin user created successfully',
//            'admin' => $admin,
//        ]);
//    }
}

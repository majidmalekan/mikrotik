<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Otp\VerifyOtpRequest;
use App\Service\UserService;
use App\Traits\SendMailTrait;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
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

    /**
     * @param UserService $user
     */
    public function __construct(UserService $user)
    {
        $this->service = $user;
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
    public function login(Request $request): RedirectResponse
    {
        $phone = $request->post('phone');
        if (!Cache::has($phone)) {
            $otp = $this->sendOtpVerification($phone);
            return redirect()
                ->route('otp', ['otp' => $otp])
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
        if ($this->verifyOtp($request))
            return redirect()->route('otp-page')->with('success', 'اینترنت شما وصل شد.');
        return redirect()->route('otp-page')->withErrors(['otp' => 'کد موقت شما صحیح نمی باشد.']);

    }
}

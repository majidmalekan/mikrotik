<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Service\UserService;
use App\Traits\SendMailTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use App\Traits\MustVerifyContact;
use App\Traits\VerifyByOtp;

class AuthController extends Controller
{
    use Notifiable, SendMailTrait,VerifyByOtp, MustVerifyContact;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $phone = $request->post('phone');
        if (!Cache::has($phone)) {
            $this->sendOtpVerification($phone);
            $user = $this->service->firstByPhone($phone);
            return success('', [
                'otp_expires_in' => env('OTP_EXPIRES_IN'),
                'otp_length' => env('OTP_LENGTH'),
                'phone' => $request->post('phone'),
                'has_verified' => $user == null ? false : $user->has_verified,
            ]);
        }
        return failed(__('auth.auth_sms_resend'), 403);
    }
}

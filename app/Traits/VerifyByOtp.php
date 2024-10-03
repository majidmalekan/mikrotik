<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Otp\VerifyOtpRequest;

trait VerifyByOtp
{

    /**
     * Generate new OTP (deletes previous ones)
     *
     * @param int|string $phone
     * @param string $keyForCache
     * @return string
     * @throws Exception
     */
    public function deleteAndGenerateOtp(int|string $phone): string
    {
        try {
            $otp = generate_otp(env('OTP_LENGTH'));
            if (Cache::has($phone))
                Cache::pull($phone);
            Cache::put($phone, $otp, env('OTP_EXPIRES_IN'));
            return $otp;
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage(), 403);
        }
    }

    /**
     * @param string $phone
     * @param string|null $companyName
     * @param string $keyForCache
     * @throws Exception
     */
    protected function sendOtpVerification(string $phone): void
    {
        $this->sendVerificationNotification($phone);
    }

    /**
     * @throws Exception
     * @throws Exception
     */
    protected function verifyOtp(VerifyOtpRequest $request): array|bool
    {

        $otp = $request->post('otp');
        $deviceLimit = false;
        if ($this->otpVerify($request->post('phone'), $otp)) {
            try {
                DB::beginTransaction();
                $user = $this->service->firstOrCreate(['phone' => strval((int)$request->post('phone'))]);
                $user->markContactAsVerified();
                $newToken = $this->createANewToken($request->post('phone'), $user);
                DB::commit();
                return [
                    "access_token" => $newToken,
                    "token_type" => env('JWT_TYPE'),
                    "expire_in" => env('JWT_TTL'),
                ];
            } catch (Exception $exception) {
                DB::rollBack();
                throw new Exception($exception->getMessage(), 403);
            }
        }
        throw new Exception(__("auth.auth_failed"), 403);
    }
}

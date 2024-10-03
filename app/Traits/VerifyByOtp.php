<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Http\Requests\OtpVerify\VerifyOtpRequest;

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
    public function deleteAndGenerateOtp(int|string $phone, string $keyForCache = ''): string
    {
        try {
            $cacheKey = ($keyForCache != '' ? $phone . $keyForCache : $phone);
//            $otp = generate_otp(env('OTP_LENGTH'));
            $otp = 1111;
            if (Cache::has($cacheKey))
                Cache::pull($cacheKey);
            Cache::put($cacheKey, $otp, env('OTP_EXPIRES_IN'));
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
    protected function sendOtpVerification(string $phone, string $companyName = null, $keyForCache = ''): void
    {
        $this->sendVerificationNotification($phone, $companyName, $keyForCache);
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

                if (filter_var($request->post('phone'), FILTER_VALIDATE_EMAIL)) {
                    $user = $this->service->firstOrCreate(['email' => $request->post('phone')]);
                    $user->markContactAsVerified($request->post('phone'));
                } else {
                    $user = $this->service->firstOrCreate(['phone' => strval((int)$request->post('phone'))]);
                    $user->markContactAsVerified();
                }
                if ($request->has('device_id')) {
                    $deviceLimit = $this->checkDeviceLimit($user->id);
                    if (!$deviceLimit) $this->storeDeviceAfterRegistration($request, $user);
                }
                $wallet = $this->createWalletForNewUser($user);
                $newToken = $this->createANewToken($request->post('phone'), $user);
                DB::commit();
                return [
                    "access_token" => $newToken,
                    "token_type" => env('JWT_TYPE'),
                    "expire_in" => env('JWT_TTL'),
                    'has_verified' => $user->has_verified,
                    'wallet' => $wallet,
                    'device' => $deviceLimit,
                ];
            } catch (Exception $exception) {
                DB::rollBack();
                throw new Exception($exception->getMessage(), 403);
            }
        }
        throw new Exception(__("auth.auth_failed"), 403);
    }
}

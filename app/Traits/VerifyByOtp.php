<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Auth;
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
            $otp = 1111;
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
     * @return int
     * @throws Exception
     */
    protected function sendOtpVerification(string $phone): int
    {
        return $this->sendVerificationNotification($phone);
    }

    /**
     * @throws Exception
     * @throws Exception
     */
    protected function verifyOtp(VerifyOtpRequest $request): array|bool
    {

        $otp = $request->post('otp');
        if ($this->otpVerify($request->post('phone'), $otp)) {
            try {
                DB::beginTransaction();
                $user = $this->service->firstOrCreate(['phone' => strval((int)$request->post('phone'))]);
                $user->markContactAsVerified();
                Auth::login($user);
                DB::commit();
                return true;
            } catch (Exception $exception) {
                DB::rollBack();
                throw new Exception($exception->getMessage(), 403);
            }
        }
        return false;
    }
}
//TODO: delete user mac address from mikrotik when logout
//TODO: user can logout
//TODO: admin can add user with what preferences
//TODO: after login see the user consumption and logout if it is unlimited is just usage not from anything
//TODO: there is default value for usage of user that admin didnt add
//TODO: admin can add limitation

<?php

namespace App\Traits;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use JetBrains\PhpStorm\Pure;
use Modules\Auth\Notifications\VerifyEmail;
use Modules\Auth\Notifications\VerifyPhone;

trait MustVerifyContact
{
    /**
     * @return bool
     */
    #[Pure]
    public function hasVerifiedContact(): bool
    {
        return $this->hasVerifiedPhone();
    }

    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhone(): bool
    {
        return !is_null($this->phone_verified_at);
    }

    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's contact as verified.
     * @param string|null $userCredentials
     * @return bool
     */
    public function markContactAsVerified(string $userCredentials = null): bool
    {
        if ($userCredentials == null) {
            if (!$this->hasVerifiedPhone()) {
                return $this->markPhoneAsVerified();
            }
        } else {
            if (!$this->hasVerifiedEmail()) {
                return $this->markEmailAsVerified();
            }
        }
        return false;
    }

    /**
     * Mark the given user's phone number as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified(): bool
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * @param int|string $userCredentials
     * @param string|null $companyName
     * @param string $keyForCache
     * @return void
     * @throws CommonException
     */
    public function sendVerificationNotification(int|string $userCredentials, string $companyName = null, string $keyForCache = ''): void
    {
//        if (filter_var($userCredentials, FILTER_VALIDATE_EMAIL)) {
        $this->deleteAndGenerateOtp($userCredentials, $keyForCache);
//            $data["name"] = $companyName == null ? request()->user()?->name : $companyName;
//            $this->sendMail($userCredentials, 'اعتبارسنجی رایانامه', 'emailVerification', $data);
//        } else
//            $this->notify(new VerifyPhone($userCredentials, $keyForCache));
    }

    /**
     * @param int|string $phone
     * @param int $otp
     * @param string $keyForCache
     * @return bool
     */
    public function otpVerify(int|string $phone, int $otp, string $keyForCache = ''): bool
    {
        $cacheKey = $keyForCache != '' ? $phone . $keyForCache : $phone;
        return Cache::get($cacheKey) == $otp;
    }

    /**
     * @param Request $request
     * @param null $user
     * @return Model|null
     * @throws BindingResolutionException
     */
    public function storeDeviceAfterRegistration(Request $request, $user = null): ?Model
    {
        return app()
            ->make(DeviceRepositoryInterface::class)
            ->updateOrCreate($this->readyAttributesForDevice($request, $user));
    }

    /**
     * @param string $fcmToken
     * @param int $userId
     * @return bool
     * @throws BindingResolutionException
     */
    public function checkFcmTokenIsUnique(string $fcmToken, int $userId): bool
    {
        $device = $this->getDeviceByFcmToken($fcmToken);
        return $this->checkUnique($device, $userId);
    }

    /**
     * @param int $userId
     * @return array|Collection
     * @throws BindingResolutionException
     */
    public function getDevices(int $userId): array|Collection
    {
        return app()
            ->make(DeviceRepositoryInterface::class)
            ->getAll($userId);
    }

    public function checkUnique($device, $userId): bool
    {
        return $device == null || $device->user_id == $userId;
    }

    /**
     * @throws BindingResolutionException
     */
    public function getDeviceByFcmToken(string $fcmToken): ?Model
    {
        return app()
            ->make(DeviceRepositoryInterface::class)
            ->getDeviceByFcmToken($fcmToken);
    }

    /**
     * @throws BindingResolutionException
     */
    public function getDeviceByDeviceId(string $deviceId): ?Model
    {
        return app()
            ->make(DeviceRepositoryInterface::class)
            ->getDeviceByDeviceId($deviceId);
    }


    /**
     * @return int
     * @throws BindingResolutionException
     */
    public function getRandomIdFromAvatars(): int
    {
        return app()
            ->make(AvatarRepositoryInterface::class)
            ->getRandomId();
    }


    /**
     * @param int $userId
     * @return bool
     * @throws BindingResolutionException
     */
    public function checkDeviceLimit(int $userId): bool
    {
        return count($this->getDevices($userId)) >= 1;
    }

    /**
     * @param Request $request
     * @param null $user
     * @return array
     * @throws BindingResolutionException
     */
    protected function readyAttributesForDevice(Request $request, $user = null): array
    {
        $inputs = $request->except(['phone', "otp", 'fcm_token']);
        if ($request->has('fcm_token') && $this->checkFcmTokenIsUnique($request->post('fcm_token'), ($user != null ? $user->id : $this->user->id))) $inputs['fcm_token'] = $request->post('fcm_token');
        $inputs["user_id"] = $user != null ? $user->id : $this->user->id;
        return $inputs;
    }

    /**
     * @param string $deviceId
     * @param int $userId
     * @return bool
     */
    public function userHasThisDevice(string $deviceId, int $userId): bool
    {
        return $this->checkSameDevice($deviceId, $userId);
    }
}

<?php

namespace App\Broadcasting;

use App\Models\User;
use App\Traits\VerifyByOtp;
use Illuminate\Notifications\Notification;
use Melipayamak\MelipayamakApi;

class MelipayamakChannel
{
    use VerifyByOtp;

    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
//    public function join(User $user): array|bool
//    {
//        //
//    }

    /**
     * Send the notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     * @return void
     * @throws \Exception
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toMelipayamak($notifiable);
        $username = config('services.melipayamak.username');
        $password = config('services.melipayamak.password');
        $from = config('services.melipayamak.sender');
        $from = 50001001;
        $api = new MelipayamakApi($username, $password);
        $sms = $api->sms('soap');
        try {
            if (strlen((string) abs($data['bodyId'])) >2) {
                $otp = $this->deleteAndGenerateOtp($data["phone"]);
                $response = $sms->sendByBaseNumber([$otp], $data['phone'], $data['bodyId']);
            } else {
                $from = '50002710085260';
                $response = $sms->send($data['phone'], $from, config('TextSms.'.$data["bodyId"]), false);
            }

            $json = json_decode($response);
            if (!isset($json) || $json < 0) {
                throw new \Exception('Melipayamak Error: ' . ($json->recId ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            throw new \Exception('Melipayamak Exception: ' . $e->getMessage());
        }
    }
}

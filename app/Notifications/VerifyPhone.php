<?php

namespace App\Notifications;

use App\Traits\VerifyByOtp;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyPhone extends Notification
{
    use Queueable,VerifyByOtp;


    protected string $sender;
    /**
     * @var mixed
     */
    public mixed $user;

    public string $userPhone;
    /**
     * @var string
     */
    public string $template;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private string $keyForCache;
    /**
     * Create a new notification instance.
     */
    public function __construct(int $userPhone, string $template = 'ostigan')
    {
        $this->sender = "1000220066";
        $this->userPhone = $userPhone;
        $this->template = $template;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['phone'];
    }

    /**
     * Get the mail representation of the notification.
     * @throws Exception
     */
    public function toPhone(object $notifiable): int
    {
        try {
            return $this->deleteAndGenerateOtp($this->userPhone);
//            return (new KavenegarMessage())
//                ->verifyLookup($this->template, (array)$otp)->from($this->sender)->to($this->userPhone=='9999999999' && $this->userPhone=='8888888888'?9363634297:$this->userPhone);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }
}

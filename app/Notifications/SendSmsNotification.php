<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SendSmsNotification extends Notification
{
    use Queueable;
    protected string $bodyId;
    protected string $phone;
    /**
     * Create a new notification instance.
     */
    public function __construct(string|int $bodyId, string|int $phone)
    {
        $this->bodyId = $bodyId;
        $this->phone = $phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['melipayamak'];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toMelipayamak($notifiable): array
    {
        return [
            'phone' => $this->phone,
            'bodyId' => $this->bodyId,
        ];
    }

}

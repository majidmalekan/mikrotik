<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Unread()
 * @method static self Read()
 */
final class StatusNotificationEnum extends Enum
{
    #[ArrayShape(['Unread' => "string", 'Read' => "string"])]
    protected static function values(): array
    {
        return [
            'Unread' => lcfirst('unread'),
            'Read' => lcfirst('Read'),
        ];
    }

    #[ArrayShape(['Unread' => "string", 'Read' => "string"])]
    protected static function labels(): array
    {
        return [
            'Unread' => __('enums.status_notification.Unread'),
            'Read' => __('enums.status_notification.Read'),
        ];
    }
}

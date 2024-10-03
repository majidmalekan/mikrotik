<?php

namespace App\Enums;


use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Accepted()
 * @method static self Rejected()
 * @method static self Pending()
 */
final class MediaAuthorizationStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Accepted' => lcfirst('Accepted'),
            'Rejected' => lcfirst('Rejected'),
            'Pending' => lcfirst('Pending'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Accepted' => __('enums.media_authorization_status.Accepted'),
            'Rejected' => __('enums.media_authorization_status.Rejected'),
            'Pending' => __('enums.media_authorization_status.Pending'),
        ];
    }
}

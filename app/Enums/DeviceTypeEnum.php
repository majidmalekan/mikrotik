<?php

namespace App\Enums;

use Closure;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Site()
 * @method static self App()
 */
final class DeviceTypeEnum extends Enum
{
    protected static function values(): array|Closure
    {
        return [
            'Site' => lcfirst('Site'),
            'App' => lcfirst('App'),
        ];
    }

    protected static function labels(): array|Closure
    {
        return [
            'Site' => __('enums.device_type.Site'),
            'App' => __('enums.device_type.App'),
        ];
    }
}

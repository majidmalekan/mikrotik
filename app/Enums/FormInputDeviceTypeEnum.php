<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self App()
 * @method static self Site()

 */
final class FormInputDeviceTypeEnum extends Enum
{

    protected static function values(): array
    {
        return [
            'App' => lcfirst('App'),
            'Site' => lcfirst('Site'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'App' => __('enums.form_input_device_type.App'),
            'Site' => __('enums.form_input_device_type.Site'),
            ];
    }
}

<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Laptop()
 * @method static self Tablet()
 * @method static self Mobile()
 * @method static self Tv()
 *
 */
final class TypeBannerResponsiveEnum extends Enum
{
    protected static function values(): array
    {
        return [
            "Laptop" => lcfirst('Laptop'),
            "Tablet" => lcfirst('Tablet'),
            "Mobile" => lcfirst('Mobile'),
            "Tv" => lcfirst('Tv'),
        ];
    }

    protected static function labels(): array
    {
        return [
            "Laptop" => __('enums.type_banner_responsive.Laptop'),
            "Tablet" => __('enums.type_banner_responsive.Tablet'),
            "Mobile" => __('enums.type_banner_responsive.Mobile'),
            "Tv" => __('enums.type_banner_responsive.Tv'),
        ];
    }
}

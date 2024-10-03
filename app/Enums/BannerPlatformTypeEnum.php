<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self App()
 * @method static self Site()
 *
 */

final class BannerPlatformTypeEnum extends Enum
{
    /**
     * @return string[]

     */
    #[ArrayShape(['App' => "string", 'Site' => "string"])]
    protected static function values(): array
    {
        return [
            'App'=>lcfirst('App'),
            'Site'=>lcfirst('Site'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['App' => "string", 'Site' => "string"])]
    protected static function labels(): array
    {
        return [
            'App' => __('enums.banner_platform_type.App'),
            'Site' => __('enums.banner_platform_type.Site'),
        ];
    }
}

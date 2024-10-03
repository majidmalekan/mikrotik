<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self IOS()
 * @method static self ANDROID()
 */
final class MobilePlatformTypeEnum extends Enum
{

    /**
     * @inheritDoc
     */
    #[ArrayShape(['IOS' => "string", 'ANDROID' => "string"])]
    protected static function values(): array
    {
        return [
            'IOS' => 'ios',
            'ANDROID' => 'android',
        ];
    }

    /**
     * @inheritDoc
     */
    #[ArrayShape(['IOS' => "string", 'ANDROID' => "string"])]
    protected static function labels(): array
    {
        return [
            'IOS' => __('enums.mobile_platform_type.IOS'),
            'ANDROID' => __('enums.mobile_platform_type.ANDROID'),
        ];
    }

}

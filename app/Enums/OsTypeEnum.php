<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self IOS()
 * @method static self ANDROID()
 */
final class OsTypeEnum extends Enum
{

    /**
     * @inheritDoc
     */
    #[ArrayShape(['IOS' => "string", 'ANDROID' => "string"])]
    protected static function values(): array
    {
        return [
            'IOS' => lcfirst('ios'),
            'ANDROID' => lcfirst('android'),
        ];
    }

    /**
     * @inheritDoc
     */
    #[ArrayShape(['IOS' => "string", 'ANDROID' => "string"])]
    protected static function labels(): array
    {
        return [
            'IOS' => __('enums.os_type.IOS'),
            'ANDROID' => __('enums.os_type.ANDROID'),
        ];
    }
}

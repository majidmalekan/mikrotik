<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Site()
 * @method static self App()
 */
final class SettingTypeEnum extends Enum
{
    /**
     * @inheritDoc
     */
    #[ArrayShape(['Site' => "string", 'App' => "string"])]
    protected static function values(): array
    {
        return [
            'Site' => 'site',
            'App' => 'app',
        ];
    }

    /**
     * @inheritDoc
     */
    #[ArrayShape(['Site' => "string", 'App' => "string"])]
    protected static function labels(): array
    {
        return [
            'Site' => __('enums.setting_type.Site'),
            'App' => __('enums.setting_type.App'),
        ];
    }
}

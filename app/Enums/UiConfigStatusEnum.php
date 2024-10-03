<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Active()
 * @method static self Inactive()
 *
 */
final class UiConfigStatusEnum extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Active' => "string", 'Inactive' => "string"])]
    protected static function values(): array
    {
        return [
            'Active'=>lcfirst('Active'),
            'Inactive'=>lcfirst('Inactive'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Active' => "string", 'Inactive' => "string"])]
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.ui_config_status.Active'),
            'Inactive' => __('enums.ui_config_status.Inactive'),
        ];
    }
}

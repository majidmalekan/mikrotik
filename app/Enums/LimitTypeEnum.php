<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Daily()
 * @method static self Monthly()
 * @method static self Annually()
 */
final class LimitTypeEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'Daily' => lcfirst('daily'),
            'Monthly' => lcfirst('monthly'),
            'Annually' => lcfirst('annually'),
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'Daily' => __('enums.limit_type.Daily'),
            'Monthly' => __('enums.limit_type.Monthly'),
            'Annually' => __('enums.limit_type.Annually'),
        ];
    }
}

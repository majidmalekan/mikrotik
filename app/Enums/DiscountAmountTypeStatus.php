<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Numeric()
 * @method static self Percent()
 *
 */
final class DiscountAmountTypeStatus extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Numeric' => "string", 'Percent' => "string"])]
    protected static function values(): array
    {
        return [
            'Numeric' => lcfirst('Numeric'),
            'Percent' => lcfirst('Percent'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Numeric' => "string", 'Percent' => "string"])]
    protected static function labels(): array
    {
        return [
            'Numeric' => __('enums.discount_amount_type_status.Numeric'),
            'Percent' => __('enums.discount_amount_type_status.Percent'),
        ];
    }
}

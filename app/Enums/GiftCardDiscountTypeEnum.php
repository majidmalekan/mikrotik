<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 *
 * @method static self Amount()
 * @method static self Percent()
 *
 */
final class GiftCardDiscountTypeEnum extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Amount' => "string", 'Percent' => "string"])]
    protected static function values(): array
    {
        return [
            'Amount' => lcfirst('Amount'),
            'Percent' => lcfirst('Percent'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Amount' => "string", 'Percent' => "string"])]
    protected static function labels(): array
    {
        return [
            'Amount' => __('enums.gift_card_discount_type.Amount'),
            'Percent' => __('enums.gift_card_discount_type.Percent'),
        ];
    }
}

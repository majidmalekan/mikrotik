<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self OnlinePayment()
 * @method static self GiftCardProduct()
 */
final class WhatForDiscountEnum extends Enum
{
    #[ArrayShape(['OnlinePayment' => "string", 'GiftCardProduct' => "string"])]
    protected static function values(): array
    {
        return [
            'OnlinePayment' => "Modules\OnlinePayment\Entities\OnlinePayment",
            'GiftCardProduct' => "Modules\GiftCard\Entities\GiftCardProduct",
        ];
    }

    #[ArrayShape(['OnlinePayment' => "string", 'GiftCardProduct' => "string"])]
    protected static function labels(): array
    {
        return [
            'OnlinePayment' => __('enums.what_for_discount.OnlinePayment'),
            'GiftCardProduct' => __('enums.what_for_discount.GiftCardProduct'),
        ];
    }
}

<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self Active()
 * @method static self Disable()
 */
final class GiftCardProductBuyPriceStatusEnum extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function values(): array
    {
        return [
            'Active' => lcfirst('Active'),
            'Disable' => lcfirst('Disable'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.gift_card_product_buy_price_status.Active'),
            'Disable' => __('enums.gift_card_product_buy_price_status.Disable'),
        ];
    }

}

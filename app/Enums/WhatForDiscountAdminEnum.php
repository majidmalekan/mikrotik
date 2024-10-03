<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self gift_card_package()
 * @method static self gift_card_product()
 * @method static self perfect_money()
 * @method static self is_null()
 * @method static self service()
 */
final class WhatForDiscountAdminEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'gift_card_package' => lcfirst('gift_card_package'),
            'gift_card_product' => lcfirst('gift_card_product'),
            'perfect_money' => lcfirst('perfect_money'),
            'service'=>lcfirst('service'),
            'is_null' => lcfirst('is_null'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'gift_card_package' => __('enums.what_for_discount_admin.gift_card_package'),
            'gift_card_product' => __('enums.what_for_discount_admin.gift_card_product'),
            'perfect_money' => __('enums.what_for_discount_admin.perfect_money'),
            'service' => __('enums.what_for_discount_admin.service'),
            'is_null' => __('enums.what_for_discount_admin.is_null'),
        ];
    }
}

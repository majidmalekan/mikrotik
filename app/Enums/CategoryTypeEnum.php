<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self gift_card()
 * @method static self online_payment()
 * @method static self perfect_money()
 * @method static self cryptocurrency()
 * @method static self metaverse()
 *
 */
final class CategoryTypeEnum extends Enum
{
    #[ArrayShape(['blog' => "string", 'gift_card' => "string", 'online_payment' => "string", 'perfect_money' => "string", 'cryptocurrency' => "string", 'metaverse' => "string"])]
    protected static function values(): array
    {
        return [
            'gift_card' => 'gift_card',
            'online_payment' => 'online_payment',
            'perfect_money' => 'perfect_money',
            'cryptocurrency' => 'cryptocurrency',
            'metaverse' => 'metaverse',
            'blog' => 'blog',
        ];
    }

    #[ArrayShape(['gift_card' => "string", 'online_payment' => "string", 'perfect_money' => "string", 'cryptocurrency' => "string", 'metaverse' => "string"])]
    protected static function labels(): array
    {
        return [
            'gift_card' => __('enums.category_type.gift_card'),
            'online_payment' => __('enums.category_type.online_payment'),
            'perfect_money' => __('enums.category_type.perfect_money'),
            'cryptocurrency' => __('enums.category_type.cryptocurrency'),
            'metaverse' => __('enums.category_type.metaverse'),
            'blog' => __('enums.category_type.blog'),
        ];
    }
}

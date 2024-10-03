<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self OnlinePayment()
 * @method static self GiftCardProduct()
 */
final class OrderableType extends Enum
{
    #[ArrayShape(['OnlinePayment' => "string", 'GiftCardProduct' => "string"])]
    protected static function values(): array
    {
        return [
            'OnlinePayment' => 'Modules\OnlinePayment\Entities\OnlinePayment',
            'GiftCardProduct' => 'Modules\GiftCard\Entities\GiftCardProduct'
        ];
    }

    #[ArrayShape(['OnlinePayment' => "string", 'GiftCardProduct' => "string"])]
    protected static function labels(): array
    {
        return [
            'OnlinePayment' => 'OnlinePayment',
            'GiftCardProduct' => 'GiftCardProduct',
        ];
    }
}

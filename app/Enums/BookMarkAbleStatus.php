<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self OnlinePayment()
 * @method static self GiftCardPackage()
 */
final class BookMarkAbleStatus extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['GiftCardPackage' => "string", 'OnlinePayment' => "string"])]
    protected static function values(): array
    {
        return [
            'GiftCardPackage' => 'Modules\GiftCard\Entities\GiftCardPackage',
            'OnlinePayment' => 'Modules\OnlinePayment\Entities\Service',
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['GiftCardPackage' => "string", 'OnlinePayment' => "string"])]
    protected static function labels(): array
    {
        return [
            'GiftCardPackage' => 'GiftCardPackage',
            'OnlinePayment' => 'OnlinePayment',
        ];
    }

}

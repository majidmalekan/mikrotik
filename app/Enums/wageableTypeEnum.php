<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self GiftCardPackage()
 * @method static self Service()
 */


final class wageableTypeEnum extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['GiftCardPackage' => "string", 'Service' => "string"])]
    protected static function values(): array
    {
        return [
            'GiftCardPackage' =>'Modules\GiftCard\Entities\GiftCardPackage',
            'Service' => 'Modules\OnlinePayment\Entities\Service',
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['GiftCardPackage' => "string", 'Service' => "string"])]
    protected static function labels(): array
    {
        return [
            'GiftCardPackage' => __('enums.wageable_type.GiftCardPackage'),
            'Service' => __('enums.wageable_type.Service'),
        ];
    }
}

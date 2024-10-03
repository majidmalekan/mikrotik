<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;


/**
 * @method static self EN_US()
 * @method static self EN_CA()
 * @method static self FA_IR()
 * @method static self AR_SA()
 * @method static self DE_DE()
 */
final class LocaleEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'EN_US' => 'en_US',
            'EN_CA' => 'en_CA',
            'FA_IR' => 'fa_IR',
            'AR_SA' => 'ar_SA',
            'DE_DE' => 'de_DE',
        ];
    }

    protected static function labels(): array
    {
        return [
            'EN_US' => __('enums.locale_enum.EN_US'),
            'EN_CA' => __('enums.locale_enum.EN_CA'),
            'FA_IR' => __('enums.locale_enum.FA_IR'),
            'AR_SA' => __('enums.locale_enum.AR_SA'),
            'DE_DE' => __('enums.locale_enum.DE_DE'),
        ];
    }
}

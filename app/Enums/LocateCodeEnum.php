<?php


namespace App\Enums;

use Spatie\Enum\Laravel\Enum;


/**
 *
 * @method static self en_en()
 * @method static self fa_fa()
 * @method static self ar_ar()
 * @method static self gr_gr()
 */
final class LocateCodeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'en_en' => lcfirst('en'),
            'fa_fa' => lcfirst('fa'),
            'ar_ar' => lcfirst('ar'),
            'gr_gr' => lcfirst('de'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'en_en' => 'انگلیسی',
            'fa_fa' => 'فارسی',
            'ar_ar' => 'عربی',
            'gr_gr' => 'آلمانی',
        ];
    }
}

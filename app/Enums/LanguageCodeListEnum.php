<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self ar()
 * @method static self zh()
 * @method static self en()
 * @method static self de()
 * @method static self fa()
 * @method static self fr()
 */
final class LanguageCodeListEnum extends Enum

{
    protected static function values(): array
    {
        return [
            'ar' => lcfirst('ar'),
            'zh' => lcfirst('zh'),
            'en' => lcfirst('en'),
            'de' => lcfirst('de'),
            'fa' => lcfirst('fa'),
            'fr' => lcfirst('fr'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'ar' => __('enums.language_code_list.ar'),
            'zh' => __('enums.language_code_list.zh'),
            'en' => __('enums.language_code_list.en'),
            'de' => __('enums.language_code_list.de'),
            'fa' => __('enums.language_code_list.fa'),
            'fr' => __('enums.language_code_list.fr'),
        ];
    }
}

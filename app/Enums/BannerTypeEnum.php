<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Carousel()
 * @method static self Slide()
 *
 */
final class BannerTypeEnum extends Enum
{

    /**
     * @return array
     */
    #[ArrayShape(['Carousel' => "string", 'Slide' => "string"])]
    protected static function values(): array
    {
        return [
            'Carousel' => lcfirst('Carousel'),
            'Slide' => lcfirst('Slide'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Carousel' => "string", 'Slide' => "string"])]
    protected static function labels(): array
    {
        return [
            'Carousel' => __('enums.banner_type.Carousel'),
            'Slide' => __('enums.banner_type.Slide'),
        ];
    }
}

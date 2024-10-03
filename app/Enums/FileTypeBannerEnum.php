<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Video()
 * @method static self Image()
 * @method static self Motion()
 * @method static self Gif()
 *
 */
final class FileTypeBannerEnum extends Enum
{

    /**
     * @return array
     */
    #[ArrayShape(['Video' => "string", 'Image' => "string", 'Motion' => "string", 'Gif' => "string"])]
    protected static function values(): array
    {
        return [
            'Video' => lcfirst('Video'),
            'Image' => lcfirst('Image'),
            'Motion' => lcfirst('Motion'),
            'Gif' => lcfirst('Gif'),
        ];
    }


    /**
     * @return string[]
     */
    #[ArrayShape(['Video' => "string", 'Image' => "string", 'Motion' => "string", 'Gif' => "string"])]
    protected static function labels(): array
    {
        return [
            'Video' => __('enums.file_type_banner.Video'),
            'Image' => __('enums.file_type_banner.Image'),
            'Motion' => __('enums.file_type_banner.Motion'),
            'Gif' => __('enums.file_type_banner.Gif'),
        ];
    }
}

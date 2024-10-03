<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Image()
 * @method static self Video()
 */
final class MediaTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Image' => lcfirst('Image'),
            'Video' => lcfirst('Video'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Image' => __('enums.media_type.Image'),
            'Video' => __('enums.media_type.Video'),
        ];
    }
}

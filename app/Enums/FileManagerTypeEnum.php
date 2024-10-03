<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self Video()
 * @method static self Image()
 * @method static self File()
 * @method static self Sound()
 * @method static self Text()
 */
final class FileManagerTypeEnum extends Enum
{
    /**
     * @return array|int[]|string[]
     */
    #[ArrayShape(['Video' => "string", 'Image' => "string", 'File' => "string", 'Sound' => "string", "Text" => "string"])]
    protected static function values(): array
    {
        return [
            'Video' => lcfirst('Video'),
            'Image' => lcfirst('Image'),
            'File' => lcfirst('File'),
            'Sound' => lcfirst('Sound'),
            'Text' => lcfirst('Text'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Video' => "string", 'Image' => "string", 'File' => "string", 'Sound' => "string", "Text" => "string"])]
    protected static function labels(): array
    {
        return [
            'Video' => __('enums.file_manager_type.Video'),
            'Image' => __('enums.file_manager_type.Image'),
            'File' => __('enums.file_manager_type.File'),
            'Sound' => __('enums.file_manager_type.Sound'),
            'Text' => __('enums.file_manager_type.Text'),
        ];
    }

}

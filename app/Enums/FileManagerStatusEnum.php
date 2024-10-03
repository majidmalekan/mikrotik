<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Active()
 * @method static self Disable()
 */
final class FileManagerStatusEnum extends Enum
{

    /**
     * @return array|int[]|string[]
     */
    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function values(): array
    {
        return [
            'Active' => lcfirst('Active'),
            'Disable' => lcfirst('Disable'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.file_manager_status.Active'),
            'Disable' => __('enums.file_manager_status.Disable'),
        ];
    }
}

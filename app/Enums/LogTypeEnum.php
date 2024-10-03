<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Create()
 * @method static self Update()
 * @method static self Delete()
 */
final class LogTypeEnum extends Enum
{

    #[ArrayShape(['Create' => "string", 'Update' => "string", 'Delete' => "string"])]
    protected static function values(): array
    {
        return [
            'Create' => lcfirst('Create'),
            'Update' => lcfirst('Update'),
            'Delete' => lcfirst('Delete'),
        ];
    }

    #[ArrayShape(['Create' => "string", 'Update' => "string", 'Delete' => "string"])]
    protected static function labels(): array
    {
        return [
            'Create' => __('enums.log_type.Create'),
            'Update' => __('enums.log_type.Update'),
            'Delete' => __('enums.log_type.Delete'),
        ];
    }
}

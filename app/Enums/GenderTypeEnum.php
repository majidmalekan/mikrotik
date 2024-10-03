<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Male()
 * @method static self Female()
 */
final class GenderTypeEnum extends Enum
{
    #[ArrayShape(['Male' => "string", 'Female' => "string"])]
    protected static function values(): array
    {
        return [
            'Male' => 'male',
            'Female' => 'female',
        ];
    }

    #[ArrayShape(['Male' => "string", 'Female' => "string"])]
    protected static function labels(): array
    {
        return [
            'Male' => __('enums.gender_type.Male'),
            'Female' => __('enums.gender_type.Female'),
        ];
    }
}

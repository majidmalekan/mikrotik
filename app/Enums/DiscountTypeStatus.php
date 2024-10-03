<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 *
 * @method static self Public ()
 * @method static self Specific()
 *
 */
final class DiscountTypeStatus extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Public' => "string", 'Specific' => "string"])]
    protected static function values(): array
    {
        return [
            'Public' => lcfirst('Public'),
            'Specific' => lcfirst('Specific'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Public' => "string", 'Specific' => "string"])]
    protected static function labels(): array
    {
        return [
            'Public' => __('enums.discount_type_status.Public'),
            'Specific' => __('enums.discount_type_status.Specific'),
        ];
    }

}

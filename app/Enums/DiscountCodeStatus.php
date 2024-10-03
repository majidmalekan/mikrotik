<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Active()
 * @method static self Expired()
 */
final class DiscountCodeStatus extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Active' => "string", 'Expired' => "string"])]
    protected static function values(): array
    {
        return [
            'Active' => lcfirst('Active'),
            'Expired' => lcfirst('Expired'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Active' => "string", 'Expired' => "string"])]
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.discount_code_status.Active'),
            'Expired' => __('enums.discount_code_status.Expired'),
        ];
    }
}

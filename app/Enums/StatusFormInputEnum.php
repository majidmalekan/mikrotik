<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Active()
 * @method static self Disable()
 *
 */
final class StatusFormInputEnum extends Enum
{
    /**
     * @return array
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
            'Active' => __('enums.status_form_input.Active'),
            'Disable' => __('enums.status_form_input.Disable'),
        ];
    }
}

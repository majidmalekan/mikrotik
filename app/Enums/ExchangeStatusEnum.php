<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Active()
 * @method static self Disable()
 */
final class ExchangeStatusEnum extends Enum
{

    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function values(): array
    {
        return [
            'Active' => lcfirst('Active'),
            'Disable' => lcfirst('Disable'),
        ];
    }

    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.exchange_status.Active'),
            'Disable' => __('enums.exchange_status.Disable'),
        ];
    }
}

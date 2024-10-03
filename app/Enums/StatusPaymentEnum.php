<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Payed()
 * @method static self Canceled()
 *
 */
final class StatusPaymentEnum extends Enum
{
    #[ArrayShape(['Payed' => "string", 'Canceled' => "string"])]
    protected static function values(): array
    {
        return [
            'Payed' => lcfirst('Payed'),
            'Canceled' => lcfirst('Canceled'),
        ];
    }

    #[ArrayShape(['Payed' => "string", 'Canceled' => "string"])]
    protected static function labels(): array
    {
        return [
            'Payed' => __('enums.status_payment.Payed'),
            'Canceled' => __('enums.status_payment.Canceled'),
        ];
    }
}

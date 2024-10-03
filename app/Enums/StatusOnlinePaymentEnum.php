<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self Completed()
 * @method static self Pending()
 * @method static self Failed()
 */
final class StatusOnlinePaymentEnum extends Enum
{

    /**
     * @return array
     */
    #[ArrayShape(['Completed' => "string", 'Pending' => "string", 'Failed' => "string"])]
    protected static function values(): array
    {
        return [
            'Completed' => lcfirst('Completed'),
            'Pending' => lcfirst('Pending'),
            'Failed' => lcfirst('Failed'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Completed' => "string", 'Pending' => "string", 'Failed' => "string"])]
    protected static function labels(): array
    {
        return [
            'Completed' => __('enums.status_online_payment.Completed'),
            'Pending' => __('enums.status_online_payment.Pending'),
            'Failed' => __('enums.status_online_payment.Failed'),
        ];
    }
}

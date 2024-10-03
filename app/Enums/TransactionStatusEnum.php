<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Blocked()
 * @method static self Pending()
 * @method static self Failed()
 * @method static self Completed()
 *
 */
final class TransactionStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Pending' => lcfirst('Pending'),
            'Completed' => lcfirst('Completed'),
            'Canceled' => lcfirst('Canceled'),
            'Failed' => lcfirst('Failed'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Pending' => __('enums.transaction_status.Pending'),
            'Completed' => __('enums.transaction_status.Completed'),
            'Canceled' => __('enums.transaction_status.Canceled'),
            'Failed' => __('enums.transaction_status.Failed'),
        ];
    }
}

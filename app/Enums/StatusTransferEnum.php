<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Pending()
 * @method static self Failed()
 * @method static self Blocked()
 * @method static self Completed()
 */
final class StatusTransferEnum extends Enum
{

    protected static function values(): array
    {
        return [
            'Pending' => lcfirst('Pending'),
            'Failed' => lcfirst('Failed'),
            'Blocked' => lcfirst('Blocked'),
            'Completed' => lcfirst('Completed'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Pending' => __('enums.status_transfer.Pending'),
            'Failed' => __('enums.status_transfer.Failed'),
            'Blocked' => __('enums.status_transfer.Blocked'),
            'Completed' => __('enums.status_transfer.Completed'),
        ];
    }
}

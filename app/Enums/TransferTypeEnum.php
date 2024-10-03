<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Instant()
 * @method static self LongTerm()
 */
final class TransferTypeEnum extends Enum
{
    /**
     * @return array|int[]|string[]
     */
    protected static function values(): array
    {
        return [
            'Instant' => lcfirst('Instant'),
            'LongTerm' => lcfirst('LongTerm'),
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'Instant' => __('enums.transfer_type.Instant'),
            'LongTerm' => __('enums.transfer_type.LongTerm'),
        ];
    }
}

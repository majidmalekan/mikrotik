<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Instant()
 * @method static self Long_term()
 *
 */
final class QrCodeWalletTypeEnum extends Enum
{
    /**
     * @return array|int[]|string[]
     */
    protected static function values(): array
    {
        return [
            'Instant' => lcfirst('Instant'),
            'Long_term' => lcfirst('Long_term'),
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'Instant' => __('enums.qr_code_wallet_type.Instant'),
            'Long_term' => __('enums.qr_code_wallet_type.Long_term'),
        ];
    }
}

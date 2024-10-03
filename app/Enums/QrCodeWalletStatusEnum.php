<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Active()
 * @method static self Disable()
 *
 */
final class QrCodeWalletStatusEnum extends Enum
{
    /**
     * @return array|int[]|string[]
     */
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
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.qr_code_wallet_status.Active'),
            'Disable' => __('enums.qr_code_wallet_status.Disable'),
        ];
    }
}

<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Active()
 * @method static self Disable()
 * @method static self Blocked()
 */
final class StatusQrCodeWalletEnum extends Enum
{

    /**
     * @return array
     */
    protected static function values(): array
    {
        return [
            'Active' => lcfirst('Active'),
            'Disable' => lcfirst('Disable'),
            'Blocked' => lcfirst('Blocked'),
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.status_qr_code_wallet.Active'),
            'Disable' => __('enums.status_qr_code_wallet.Disable'),
            'Blocked' => __('enums.status_qr_code_wallet.Blocked'),
        ];
    }
}

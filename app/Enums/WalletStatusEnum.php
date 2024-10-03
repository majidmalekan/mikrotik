<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Blocked()
 * @method static self Limited()
 * @method static self Active()
 *
 */
final class WalletStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Blocked' => lcfirst('Blocked'),
            'Limited' => lcfirst('Limited'),
            'Active' => lcfirst('Active'),

        ];
    }

    protected static function labels(): array
    {
        return [
            'Blocked' => __('enums.wallet_status.Blocked'),
            'Limited' => __('enums.wallet_status.Limited'),
            'Active' => __('enums.wallet_status.Active'),
        ];
    }
}

<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;


/**
 *
 * @method static self Active()
 * @method static self Inactive()
 *
 */
final class WalletPaymentPoliciesStatusEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Active'=>lcfirst('active'),
            'Inactive'=>lcfirst('Inactive'),
        ];
    }
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.wallet_payment_policies_status.Active'),
            'Inactive' => __('enums.wallet_payment_policies_status.Inactive'),
        ];
    }
}

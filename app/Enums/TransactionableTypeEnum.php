<?php

namespace App\Enums;

use Modules\Order\Entities\Order;
use Modules\Payment\Entities\Payment;
use Modules\Wallet\Entities\Transfer;
use Modules\Wallet\Entities\Withdrawal;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Payment()
 * @method static self Order()
 * @method static self Transfer()
 * @method static self Withdrawal()
 *
 */
final class TransactionableTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Payment' => Payment::class,
            'Order' => Order::class,
            'Transfer' => Transfer::class,
            'Withdrawal' => Withdrawal::class,
        ];
    }

    protected static function labels(): array
    {
        return [
            'Payment' => __('enums.transactionable_type.Payment'),
            'Order' => __('enums.transactionable_type.Order'),
            'Transfer' => __('enums.transactionable_type.Transfer'),
            'Withdrawal' => __('enums.transactionable_type.Withdrawal'),
        ];
    }

}

<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self payment()
 * @method static self bankAccount()
 * @method static self discount()
 * @method static self onlinePayment()
 * @method static self order()
 * @method static self nationalCard()
 * @method static self onlinePaymentResponse()
 * @method static self ticket()
 */
final class NotificationAbleEnum extends Enum
{
    /**
     * @return array{payment: string,ticket:string,  bankAccount: string, discount: string, onlinePayment: string, order: string, nationalCard: string}
     */
    #[ArrayShape(['onlinePaymentResponse' => 'string', 'ticket' => 'string', 'payment' => "string", 'bankAccount' => "string", 'discount' => "string", 'onlinePayment' => "string", 'order' => "string", 'nationalCard' => "string"])]
    protected static function values(): array
    {
        return [
            'payment' => 'Modules\Payment\Entities\Payment',
            'bankAccount' => 'Modules\Auth\Entities\BankAccount',
            'discount' => 'Modules\Discount\Entities\Discount',
            'onlinePayment' => 'Modules\OnlinePayment\Entities\OnlinePayment',
            'onlinePaymentResponse' => 'Modules\OnlinePayment\Entities\OnlinePaymentResponse',
            'order' => 'Modules\Order\Entities\Order',
            'nationalCard' => 'Modules\Auth\Entities\NationalCard',
            'ticket' => 'Modules\Ticket\Entities\Ticket',
        ];
    }

    /**
     * @return array{payment: string,ticket:string, authenticationResult: string, bankAccount: string, discount: string, onlinePayment: string, order: string, nationalCard: string}
     */
    #[ArrayShape(['onlinePaymentResponse' => 'string', 'ticket' => 'string', 'payment' => "string", 'bankAccount' => "string", 'discount' => "string", 'onlinePayment' => "string", 'order' => "string", 'nationalCard' => "string"])]
    protected static function labels(): array
    {
        return [
            'payment' => __('enums.notification_able.payment'),
            'bankAccount' => __('enums.notification_able.bankAccount'),
            'discount' => __('enums.notification_able.discount'),
            'onlinePayment' => __('enums.notification_able.onlinePayment'),
            'onlinePaymentResponse' => __('enums.notification_able.onlinePaymentResponse'),
            'order' => __('enums.notification_able.order'),
            'nationalCard' => __('enums.notification_able.nationalCard'),
            'ticket' => __('enums.notification_able.ticket'),
        ];
    }
}

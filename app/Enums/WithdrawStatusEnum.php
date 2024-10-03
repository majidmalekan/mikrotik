<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Pending()
 * @method static self Canceled()
 * @method static self Accepted()
 *
 */
final class WithdrawStatusEnum extends Enum
{
    /**
     * @return array{Pending: string, Canceled: string, Accepted: string}
     */
    #[ArrayShape(['Pending' => "string", 'Canceled' => "string", 'Accepted' => "string"])]
    public static function values(): array
    {
        return [
            'Pending' => lcfirst('Pending'),
            'Canceled' => lcfirst('Canceled'),
            'Accepted' => lcfirst('Accepted'),
        ];
    }

    /**
     * @return array{Pending: string, Canceled: string, Accepted: string}
     */
    #[ArrayShape(['Pending' => "string", 'Canceled' => "string", 'Accepted' => "string"])]
    public static function labels(): array
    {
        return [
            'Pending' => __('enums.withdraw_status.Pending'),
            'Canceled' => __('enums.withdraw_status.Canceled'),
            'Accepted' => __('enums.withdraw_status.Accepted'),
        ];
    }
}

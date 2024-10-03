<?php

namespace App\Enums;

use Modules\Wallet\Entities\QrCodeWallet;
use Modules\Wallet\Entities\Wallet;
use Spatie\Enum\Laravel\Enum;


/**
 *
 * @method static self Wallet()
 * @method static self QRCodeWallet()
 *
 */
final class TransferableTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Wallet' => Wallet::class,
            'QRCodeWallet' => QrCodeWallet::class,
        ];
    }

    protected static function labels(): array
    {
        return [
            'Wallet' => __('enums.transferable_type.Wallet'),
            'QRCodeWallet' => __('enums.transferable_type.QRCodeWallet'),
        ];
    }
}

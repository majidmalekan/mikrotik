<?php

namespace App\Enums;

use Illuminate\Support\Facades\App;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Saman()
 * @method static self Zarinpal()
 * @method static self Stripe()
 * @method static self Paypal()
 *
 */
final class DriverPaymentEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Saman' => lcfirst('Saman'),
            'Zarinpal' => lcfirst('Zarinpal'),
            'Stripe' => lcfirst('Stripe'),
            'Paypal' => lcfirst('Paypal'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Saman' => __('enums.driver_payment.Saman'),
            'Zarinpal' => __('enums.driver_payment.Zarinpal'),
            'Stripe' => __('enums.driver_payment.Stripe'),
            'Paypal' => __('enums.driver_payment.Paypal'),
        ];
    }

//    public static function toArray(): array
//    {
//        $locale = App::getLocale();
//
//        $availableDrivers = config("payment.drivers.$locale.available", config('payment.drivers.ar.available'));
//        $array = [];
//        $arrays = [];
//        foreach ($availableDrivers as $definition) {
//            $array["value"] = $definition;
//            $array["label"] = self::{ucfirst($definition)}()->label;
//            $array["logo"] = url("/bank-iran/" . config("BankConstantEnglishName.$definition") . ".png");
//            $arrays[] = $array;
//        }
//        return $arrays;
//    }
}

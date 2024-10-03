<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;


/**
 * @method static self Amount()
 * @method static self Percent()
 */

final class WageTypeEnum extends Enum
{

    protected static function values()
    {
        return [
            'Amount'=>lcfirst('Amount'),
            'Percent'=>lcfirst('Percent')
        ];
    }

    protected static function labels()
    {
        return [
            'Amount' => __('enums.wage_type.Amount'),
            'Percent' => __('enums.wage_type.Percent'),
        ];
    }
}

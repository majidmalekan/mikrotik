<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;


/**
 * @method static self Financial()
 * @method static self Technical()
 * @method static self Sales()
 */
final class DepartmentTicketEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Financial' => lcfirst('Financial'),
            'Technical' => lcfirst('Technical'),
            'Sales' => lcfirst('Sales'),
        ];
    }

    protected static function labels(): array
    {
        return [
            "Financial" => "دپارتمان مالی",
            "Technical" => "دپارتمان فنی",
            "Sales" => "دپارتمان فروش",
        ];
    }
}

<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Emergency()
 * @method static self High()
 * @method static self Middle()
 * @method static self Low()
 */
final class PriorityTicketEnum extends Enum
{
    #[ArrayShape(['Emergency' => "string", 'High' => "string", 'Middle' => "string", 'Low' => "string"])]
    protected static function values(): array
    {
        return [
            'Emergency' => lcfirst('Emergency'),
            'High' => lcfirst('High'),
            'Middle' => lcfirst('Middle'),
            'Low' => lcfirst('Low'),
        ];
    }

    #[ArrayShape(['Emergency' => "string", 'High' => "string", 'Middle' => "string", 'Low' => "string"])]
    protected static function labels(): array
    {
        return [
            'Emergency' => 'بحرانی',
            'High' => 'بالا',
            'Middle' => 'متوسط',
            'Low' => 'پایین',
        ];
    }
}

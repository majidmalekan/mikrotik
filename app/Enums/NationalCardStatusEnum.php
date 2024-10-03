<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;
/**
 * @method static self Seen()
 * @method static self Unseen()
 */
final class NationalCardStatusEnum extends Enum
{
    #[ArrayShape(['Seen' => "string", 'Unseen' => "string"])]
    protected static function values(): array
    {
        return [
            'Seen' => __('enums.national_card_status.Seen'),
            'Unseen' => __('enums.national_card_status.Unseen'),
        ];
    }

    #[ArrayShape(['Seen' => "string", 'Unseen' => "string"])]
    protected static function labels(): array
    {
        return [
            'Seen' => 'Gesehen',
            'Unseen' => 'Ungesehen',
        ];
    }
}

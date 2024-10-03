<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Draft()
 * @method static self Active()
 * @method static self Disable()
 * @method static self Unavailable()
 */
final class GiftCardStatusEnum extends Enum
{
    #[ArrayShape(['Draft' => "string", 'Active' => "string", 'Disable' => "string", 'Unavailable' => "string"])]
    protected static function values(): array
    {
        return [
            'Draft' => lcfirst('Draft'),
            'Active' => lcfirst('Active'),
            'Disable' => lcfirst('Disable'),
            'Unavailable' => lcfirst('Unavailable'),
        ];
    }

    #[ArrayShape(['Draft' => "string", 'Active' => "string", 'Disable' => "string", 'Unavailable' => "string"])]
    protected static function labels(): array
    {
        return [
            'Draft' => __('enums.gift_card_status.Draft'),
            'Active' => __('enums.gift_card_status.Active'),
            'Disable' => __('enums.gift_card_status.Disable'),
            'Unavailable' => __('enums.gift_card_status.Unavailable'),
        ];
    }
}

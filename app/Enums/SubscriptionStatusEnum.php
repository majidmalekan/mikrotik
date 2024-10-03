<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Active()
 * @method static self Disable()
 */
final class SubscriptionStatusEnum extends Enum
{
    /**
     * @return array|int[]|string[]
     */
    protected static function values(): array
    {
        return [
            'Active' => lcfirst('Active'),
            'Disable' => lcfirst('Disable'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Active' => "string", 'Disable' => "string"])]
    protected static function labels(): array
    {
        return [
            'Active' => __('enums.subscription_status.Active'),
            'Disable' => __('enums.subscription_status.Disable'),
        ];
    }
}

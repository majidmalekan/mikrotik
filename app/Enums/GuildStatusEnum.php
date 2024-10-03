<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Pending()
 * @method static self Rejected()
 * @method static self Approved()
 */
final class GuildStatusEnum extends Enum
{


    #[ArrayShape(['Pending' => "string", 'Rejected' => "string", 'Approved' => "string"])]
    protected static function values(): array
    {
        return [
            'Pending' => lcfirst("Pending"),
            'Rejected' => lcfirst("Rejected"),
            'Approved' => lcfirst("Approved"),
        ];
    }

    #[ArrayShape(["Pending" => "string", "Rejected" => "string", "Approved" => "string"])]
    protected static function labels(): array
    {
        return [
            'Pending' => __('enums.guild_status.Pending'),
            'Rejected' => __('enums.guild_status.Rejected'),
            'Approved' => __('enums.guild_status.Approved'),
        ];
    }
}

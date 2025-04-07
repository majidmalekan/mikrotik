<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Pending()
 * @method static self Closed()
 * @method static self Answered()
 * @method static self Pending_background_color()
 * @method static self Pending_text_color()
 * @method static self Closed_text_color()
 * @method static self Closed_background_color()
 * @method static self Answered_background_color()
 * @method static self Answered_text_color()
 */
final class StatusTicketEnum extends Enum
{
    #[ArrayShape(['Pending' => "string", 'Closed' => "string", 'Answered' => "string"])]
    protected static function values(): array
    {
        return [
            'Pending' => lcfirst('Pending'),
            'Closed' => lcfirst('Closed'),
            'Answered' => lcfirst('Answered'),
        ];
    }

    #[ArrayShape(['Pending' => "string", 'Closed' => "string", 'Answered' => "string", 'Pending_background_color' => "string", 'Pending_text_color' => "string", 'Closed_text_color' => "string", 'Closed_background_color' => "string", 'Answered_background_color' => "string", 'Answered_text_color' => "string"])]
    protected static function labels(): array
    {
        return [
            'Pending' => 'منتظر پاسخ',
            'Closed' => 'بسته شده',
            'Answered' => 'جواب داده شده',
            'Pending_background_color' => '#FEEEDF',
            'Pending_text_color' => 'text-pending',
            'Closed_text_color' => 'text-closed',
            'Closed_background_color' => '#E4F2EE',
            'Answered_background_color' => '#EBF0FE',
            'Answered_text_color' => 'text-answered',
        ];
    }
}

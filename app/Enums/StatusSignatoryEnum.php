<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Accepted()
 * @method static self Rejected()
 * @method static self Pending()
 */
final class StatusSignatoryEnum extends Enum
{
    /**
     * @return array{Accept: string, Reject: string, Pending: string}
     */
    #[ArrayShape(['Accepted' => "string", 'Rejected' => "string", 'Pending' => "string"])]
    protected static function values(): array
    {
        return [
            'Accepted' => lcfirst('Accepted'),
            'Rejected' => lcfirst('Rejected'),
            'Pending' => lcfirst('Pending'),
        ];
    }

    /**
     * @return array{Pending: string, Accept: string, Reject: string}
     */
    #[ArrayShape(['Pending' => "string", 'Accepted' => "string", 'Rejected' => "string"])]
    protected static function labels(): array
    {
        return [
            'Pending' => __('enums.status_signatory.Pending'),
            'Accepted' => __('enums.status_signatory.Accepted'),
            'Rejected' => __('enums.status_signatory.Rejected'),
        ];
    }
}

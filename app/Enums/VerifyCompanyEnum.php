<?php

namespace App\Enums;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Accept()
 * @method static self Reject()
 * @method static self Pending()
 */
final class VerifyCompanyEnum extends Enum
{

    /**
     * @return array{Accept: string, Reject: string, Pending: string}
     */
    #[ArrayShape(['Accept' => "string", 'Rejected' => "string", 'Pending' => "string"])]
    protected static function values(): array
    {
        return [
            'Accept'=>lcfirst('Accept'),
            'Rejected'=>lcfirst('Rejected'),
            'Pending'=>lcfirst('Pending'),
        ];
    }

    /**
     * @return array{Pending: string, Accept: string, Reject: string}
     */
    #[ArrayShape(['Pending' => "string", 'Accept' => "string", 'Rejected' => "string"])]
    protected static function labels(): array
    {
        return [
            'Pending' => __('enums.verify_company.Pending'),
            'Accept' => __('enums.verify_company.Accept'),
            'Rejected' => __('enums.verify_company.Rejected'),
        ];
    }
}

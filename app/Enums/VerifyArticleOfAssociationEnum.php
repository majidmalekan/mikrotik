<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;


/**
 * @method static self Accepted()
 * @method static self Rejected()
 * @method static self Pending()
 */

final class VerifyArticleOfAssociationEnum extends Enum
{
    /**
     * @return array{Accept: string, Reject: string, Pending: string}
     */
    #[ArrayShape(['Accepted' => "string", 'Rejected' => "string", 'Pending' => "string"])]
    protected static function values(): array
    {
        return [
            'Accepted'=>lcfirst('Accepted'),
            'Rejected'=>lcfirst('Rejected'),
            'Pending'=>lcfirst('Pending'),
        ];
    }

    /**
     * @return array{Pending: string, Accept: string, Reject: string}
     */
    #[ArrayShape(['Pending' => "string", 'Accepted' => "string", 'Rejected' => "string"])]
    protected static function labels(): array
    {
        return [
            'Pending' => __('enums.verify_article_of_association.Pending'),
            'Accepted' => __('enums.verify_article_of_association.Accepted'),
            'Rejected' => __('enums.verify_article_of_association.Rejected'),
        ];
    }
}

<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Category()
 * @method static self GiftCardPackage()
 * @method static self GiftCardProduct()
 * @method static self Notification()
 * @method static self Form()
 * @method static self FromInput()
 * @method static self Service()

 * @method static self Currency()
 * @method static self Region()
 * @method static self Subscription()
 * @method static self Tag()
 * @method static self Subject()
 * @method static self Ticket()
 */

final class MultiLangAbleEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Category' => ucfirst('Category'),
            'GiftCardPackage' => ucfirst('GiftCardPackage'),
            'GiftCardProduct' => ucfirst('GiftCardProduct'),
            'Notification' => ucfirst('Notification'),
            'Form' => ucfirst('Form'),
            'FormInput' => ucfirst('FormInput'),
            'Service'=>ucfirst('Service'),
            'Currency'=>ucfirst('Currency'),
            'Region'=>ucfirst('Region'),
            'Subscription'=>ucfirst('Subscription'),
            'Tag'=>ucfirst('Tag'),
            'Subject'=>ucfirst('Subject'),
            'Ticket'=> ucfirst('Ticket'),
        ];
    }

    /**
     * @inheritDoc
     */
    protected static function labels(): array
    {
        return [
            'Category' => '/v1/admin/category',
            'GiftCardPackage' => '/v1/admin/gift-card-packages',
            'GiftCardProduct' => '/v1/admin/gift-card-products',
            'Notification' => '/v1/admin/notifications',
            'Form' => '/v1/admin/form',
            'FromInput' => '/v1/admin/form-input',
            'Service'=>'/v1/admin/services',
            'Currency'=>'v1/admin/currencies',
            'Region'=>'v1/admin/regions',
            'Subscription'=>'v1/admin/subscription',
            'Tag'=>'v1/admin/tags',
            'Subject'=>'v1/admin/subjects',
            'Ticket'=>'v1/admin/tickets',
        ];
    }
}

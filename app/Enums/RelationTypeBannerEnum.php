<?php

namespace App\Enums;

use JetBrains\PhpStorm\ArrayShape;
use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Link()
 * @method static self Entity()
 *
 */
final class RelationTypeBannerEnum extends Enum
{
    /**
     * @return array
     */
    #[ArrayShape(['Link' => "string", 'Entity' => "string"])]
    protected static function values(): array
    {
        return [
            'Link' => lcfirst('Link'),
            'Entity' => lcfirst('Entity'),
        ];
    }

    /**
     * @return string[]
     */
    #[ArrayShape(['Link' => "string", 'Entity' => "string"])]
    protected static function labels(): array
    {
        return [
            'Link' => __('enums.relation_type_banner.Link'),
            'Entity' => __('enums.relation_type_banner.Entity'),
        ];
    }
}

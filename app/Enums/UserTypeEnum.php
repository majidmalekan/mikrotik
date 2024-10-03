<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self User()
 * @method static self Company()
 * @method static self Guild()
 */
final class UserTypeEnum extends Enum
{
    /**
     * @return string[]
     */
    protected static function values(): array
    {
        return [
            'User' => lcfirst('user'),
            'Company' => lcfirst('company'),
            'Guild' => lcfirst('guild'),
        ];
    }

    /**
     * @return string[]
     */
    protected static function labels(): array
    {
        return [
            'User' => __('enums.user_type.User'),
            'Company' => __('enums.user_type.Company'),
            'Guild' => __('enums.user_type.Guild'),
        ];
    }
}

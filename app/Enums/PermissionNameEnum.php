<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self full_permission()
 * @method static self Write()
 * @method static self Edit()
 * @method static self Destroy()
 * @method static self Block()
 *
 */
final class PermissionNameEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'full_permission' => lcfirst('full_permission'),
            'Write' => lcfirst('Write'),
            'Edit' => lcfirst('Edit'),
            'Destroy' => lcfirst('Destroy'),
            'View' => lcfirst('View'),
            'Block' => lcfirst('Block'),
        ];
    }


    public static function labels(): array
    {
        return [
            'full_permission' => __('enums.permission_name.full_permission'),
            'Write' => __('enums.permission_name.Write'),
            'Edit' => __('enums.permission_name.Edit'),
            'Destroy' => __('enums.permission_name.Destroy'),
            'View' => __('enums.permission_name.View'),
            'Block' => __('enums.permission_name.Block'),
        ];
    }
}

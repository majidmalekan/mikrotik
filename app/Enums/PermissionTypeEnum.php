<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 *
 * @method static self Marketing()
 * @method static self Accountant()
 * @method static self Develop()
 * @method static self Sale()
 * @method static self Management()
 * @method static self Supporting()
 * @method static self Administrative()
 * @method static self Collaborator()
 * @method static self CTO()
 * @method static self CEO()
 *
 */
final class PermissionTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'Marketing' => lcfirst('Marketing'),
            'Accountant' => lcfirst('Accountant'),
            'Develop' => lcfirst('Develop'),
            'Sale' => lcfirst('Sale'),
            'Management' => lcfirst('Management'),
            'Supporting' => lcfirst('Supporting'),
            'Administrative' => lcfirst('Administrative'),
            'Collaborator' => lcfirst('Collaborator'),
            'CTO' => strtolower('CTO'),
            'CEO' => strtolower('CEO'),
        ];
    }

    protected static function labels(): array
    {
        return [
            'Marketing' => __('enums.permission_type.Marketing'),
            'Accountant' => __('enums.permission_type.Accountant'),
            'Develop' => __('enums.permission_type.Develop'),
            'Sale' => __('enums.permission_type.Sale'),
            'Management' => __('enums.permission_type.Management'),
            'Supporting' => __('enums.permission_type.Supporting'),
            'Administrative' => __('enums.permission_type.Administrative'),
            'Collaborator' => __('enums.permission_type.Collaborator'),
            'CTO' => __('enums.permission_type.CTO'),
            'CEO' => __('enums.permission_type.CEO'),
        ];
    }
}

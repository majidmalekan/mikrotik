<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self Admin()
 * @method static self Supervisor()
 * @method static self User()
 */
final class UserRoleEnum extends Enum
{
    protected static function values(): array
    {
        return [
          "Admin"=>lcfirst('Admin'),
          "Supervisor"=>lcfirst('Supervisor'),
          "User"=>lcfirst('User'),
        ];
    }

    protected static function labels(): array
    {
        return [
            "Admin"=>"مدیرکل",
            "Supervisor"=>"مدیر ناظر",
            "User"=>"کاربر عادی",
        ];
    }
}

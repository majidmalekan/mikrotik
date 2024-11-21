<?php

namespace App\Repository\User;


use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function firstOrCreate(array $attributes): Model;
}

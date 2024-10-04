<?php

namespace App\Service;

use App\Repository\User\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserService extends BaseService
{
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array $attributes
     * @return Model|Authenticatable
     */
    public function firstOrCreate(array $attributes): Model|Authenticatable
    {
        return $this->repository->firstOrCreate($attributes);
    }
}

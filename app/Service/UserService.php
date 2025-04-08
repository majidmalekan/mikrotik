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

    /**
     * @param int $id
     * @param array $attributes
     * @param array|null $macAddressRelation
     * @param array|null $ipAddressRelation
     * @return mixed
     */
    public function updateAndFetchWithRelation(int $id, array $attributes, array $macAddressRelation = null,array $ipAddressRelation=null): mixed
    {
        return $this->repository->updateAndFetchWithRelation($id, $attributes, $macAddressRelation,$ipAddressRelation);
    }

    /**
     * @param int $userId
     * @param string $macAddress
     * @return bool
     */
    public function isMacAddressExists(int $userId, string $macAddress): bool
    {
        return $this->repository->isMacAddressExists($userId, $macAddress);
    }

    /**
     * @param int $userId
     * @param string $ipAddress
     * @return mixed
     */
    public function isIpAddressExists(int $userId, string $ipAddress): mixed
    {
        return $this->repository->isIpAddressExists($userId, $ipAddress);
    }

    /**
     * @return mixed
     */
    public function getAllNormalUser(): mixed
    {
        return $this->repository->getAllNormalUser();
    }

    /**
     * @return mixed
     */
    public function getAllSupervisorUser(): mixed
    {
        return $this->repository->getAllSupervisorUser();
    }
}

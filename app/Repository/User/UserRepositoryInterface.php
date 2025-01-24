<?php

namespace App\Repository\User;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function firstOrCreate(array $attributes): Model;

    /**
     * @param int $id
     * @param array $attributes
     * @param array|null $macAddressRelation
     * @param array|null $ipAddressRelation
     * @return Model|null
     */
    public function updateAndFetchWithRelation(int $id, array $attributes, array $macAddressRelation=null,array $ipAddressRelation=null): ?Model;

    /**
     * @param int $userId
     * @param string $macAddress
     * @return bool
     */
    public function isMacAddressExists(int $userId, string $macAddress): bool;

    /**
     * @param int $userId
     * @param string $ipAddress
     * @return mixed
     */
    public function isIpAddressExists(int $userId, string $ipAddress): mixed;

    /**
     * @return Collection
     */
    public function getAllNormalUser(): Collection;


    public function getAdminPhoneNumber(): string|int;
}

<?php

namespace App\Service;

use App\Repository\User\UserRepositoryInterface;
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
     * @return Model
     */
    public function firstOrCreate(array $attributes): Model
    {
        return $this->repository->firstOrCreate($attributes);
    }

    /**
     * @param int $id
     * @param Request $request
     * @param array|null $whereAttributes
     * @return mixed
     */
    public function updateAndFetchWithRelation(int $id, Request $request,array $whereAttributes=null): mixed
    {
        return $this->repository->updateAndFetchWithRelation($id, $request,$whereAttributes);
    }

    /**
     * @param array $attributes
     * @param int|null $roleId
     * @return Model|null
     */
    public function createWithRelation(array $attributes, int $roleId = null): ?Model
    {
        return $this->repository->createWithRelation($attributes, $roleId);
    }

    /**
     * @param $phone
     * @return Model|null
     */
    public function firstByPhone($phone): ?Model
    {
        return $this->repository->firstByPhone($phone);
    }

    /**
     * @param $email
     * @return Model|null
     */
    public function firstByEmail($email): ?Model
    {
        return $this->repository->firstByEmail($email);
    }

    /**
     * @return array
     */
    public function allUserId(): array
    {
        return $this->repository->allUserId();
    }


    /**
     * @param int $userId
     * @param array $settingIds
     * @return Model|null
     */
    public function updateUserSettingData(int $userId, array $settingIds): ?Model
    {
        return $this->updateUserSettingData($userId, $settingIds);
    }


    /**
     * @param $user
     * @return Collection|null
     */
    public function getUserSettings($user): ?Collection
    {
        return $this->repository->getUserSettings($user);
    }


    /**
     * @param int $userId
     * @return mixed
     */
    public function removeAllUserRoles(int $userId): mixed
    {
        return $this->repository->removeAllUserRoles($userId);
    }


    public function addUserRole(int $userId, array $rolesId)
    {
        return $this->repository->addUserRole($userId, $rolesId);

    }


    /**
     * @param int $userId
     * @return Model|null
     */
    public function userRolesFind(int $userId): ?Model
    {
        return $this->repository->userRolesFind($userId);
    }

    public function attempt($inputs)
    {
        return $this->repository->attempt($inputs);
    }

    /**
     * @param int $settingId
     * @param Model|null $user
     * @return mixed
     */
    public function userChooseASetting(int $settingId, ?Model $user): mixed
    {
        return $this->repository->userChooseASetting($settingId, $user);
    }

    /**
     * @param int $settingId
     * @param Model|null $user
     * @return mixed
     */
    public function userDetachASetting(int $settingId, ?Model $user): mixed
    {
        return $this->repository->userDetachASetting($settingId, $user);
    }

    public function userHaveThisSetting(?Model $user, int $settingId)
    {
        return $this->repository->userHaveThisSetting($user, $settingId);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function activeOrDisableGuild(int $userId): mixed
    {
        return $this->repository->activeOrDisableGuild($userId);
    }
}

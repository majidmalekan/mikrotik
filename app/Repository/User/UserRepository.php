<?php

namespace App\Repository\User;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function firstOrCreate(array $attributes): Model
    {
        return $this->model
            ->query()
            ->firstOrCreate($attributes, $attributes);
    }

    /**
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function index(Request $request, int $perPage): LengthAwarePaginator
    {
            return $this->model->query()
                ->when($request->has('search'), function ($query) use ($request) {
                    $query->where('phone', '=', $request->get('search'));
                })
                ->when($request->user()->role==UserRoleEnum::Supervisor()->value, function ($query) use ($request) {
                    $query->where('parent_id', '=', $request->user()->id);
                })
                ->orderBy($request->get('sort', 'id'), $request->get('direction', 'DESC'))
                ->paginate($perPage, ['*'], 'page', $request->get('page', 1));
    }

    /**
     * @param int $id
     * @param array $attributes
     * @param array|null $macAddressRelation
     * @param array|null $ipAddressRelation
     * @return Model|null
     * @throws \Exception
     */
    public function updateAndFetchWithRelation(int $id, array $attributes, array $macAddressRelation = null, array $ipAddressRelation = null): ?Model
    {
        try {
            DB::beginTransaction();
            $user = $this->updateAndFetch($id, $attributes);
            if (!is_null($macAddressRelation))
                $user->macAddress()->create($macAddressRelation);
            if (!is_null($ipAddressRelation))
                $user->ipAddress()->create($ipAddressRelation);
            DB::commit();
            return $user;
        } catch (\Exception $exception) {
            throw new \Exception($exception);
        }
    }

    public function isMacAddressExists(int $userId, string $macAddress): bool
    {
        return $this->find($userId)
            ->macAddress()
            ->where('mac_address', $macAddress)
            ->exists();
    }

    public function isIpAddressExists(int $userId, string $ipAddress): bool
    {
        return $this->find($userId)
            ->ipAddress()
            ->where('ip_address', $ipAddress)
            ->exists();
    }

    public function getAllNormalUser(): Collection
    {
        return $this->model->query()
            ->where('is_vip', '=', 0)
            ->where('role', '=', UserRoleEnum::User()->value)
            ->get();
    }

    public function getAdminPhoneNumber(): string|int
    {
        return $this->model->query()
            ->where('role', '=', UserRoleEnum::Admin()->value)
            ->first()?->phone;
    }
}

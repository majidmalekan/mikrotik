<?php

namespace App\Repository;

use App\Traits\CacheRepositoryTrait;
use App\Traits\DBTransactionLockedTrait;
use App\Traits\TableInformationTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BaseRepository implements BaseEloquentRepositoryInterface
{
    use TableInformationTrait, CacheRepositoryTrait, DBTransactionLockedTrait;

    /**
     * @var Model
     */

    public Model $model;

    /**
     * @param $model
     */


    public function __construct($model)
    {
        $this->model = $model;
    }


    /**
     * @param int $id
     * @param array $attributes
     * @param array|null $whereAttributes
     * @return bool
     */
    public function update(int $id, array $attributes, array $whereAttributes = null): bool
    {
        $this->clearCache('index');
        $this->clearCache('find', $id);
        return $this->model->query()
            ->where('id', $id)
            ->when($whereAttributes != null, function ($query) use ($whereAttributes) {
                $query->where($whereAttributes);
            })
            ->update($attributes);
    }


    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return Cache::remember($this->getTableName() . '_find_' . (auth('sanctum')->check() ? request()->user('sanctum')->id . $id : $id), env('CACHE_EXPIRE_TIME'), function () use ($id) {
            return $this->model
                ->query()
                ->findOrFail($id);
        });
    }


    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        $this->clearCache('index');
        return $this->model
            ->query()
            ->create($attributes);
    }

    /**
     * @param int $id
     * @param array|null $whereAttributes
     * @return mixed
     * @throws BindingResolutionException
     */
    public function delete(int $id, array $whereAttributes = null): mixed
    {
        $this->clearCache('find', $id);
        $this->clearCache('index');
        return $this->model
            ->query()
            ->where('id', $id)
            ->when($whereAttributes != null, function ($query) use ($whereAttributes) {
                $query->where($whereAttributes);
            })
            ->delete();
    }


    /**
     * @param Request $request
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function index(Request $request, int $perPage): LengthAwarePaginator
    {

        return Cache::remember($this->getTableName() . '_index_', env('CACHE_EXPIRE_TIME'),
            function () use ($request, $perPage) {
                return $this->model->query()
                    ->when($request->user(), function ($query) use ($request) {
                        $query->when(!$request->user()->is_admin, function ($query) use ($request) {
                            $query->where('user_id', $request->user()->id);
                        });
                    })
                    ->when($request->has('filter'), function ($query) use ($request) {
                        $query->where($request->input('filter'), '=', $request->get('filter_value'));
                    })
                    ->orderBy($request->get('sort', 'id'), $request->get('direction', 'DESC'))
                    ->paginate($perPage, '*', '', $request->get('page', 1));

            });
    }

    /**
     * @param int $id
     * @param array|null $whereAttributes
     * @return Model|null
     */
    public function show(int $id, array $whereAttributes = null): ?Model
    {
        return Cache::remember($this->getTableName() . '_find_' . (auth('sanctum')->check() ? request()->user('sanctum')->id . $id : $id), env('CACHE_EXPIRE_TIME'), function () use ($id, $whereAttributes) {
            return $this->model
                ->query()
                ->where('id', $id)
                ->when($whereAttributes != null, function ($query) use ($whereAttributes) {
                    $query->where($whereAttributes);
                })
                ->firstOrFail();
        });

    }

    /**
     * @param int $id
     * @param array $attributes
     * @param array|null $whereAttributes
     * @return Model|null
     */
    public function updateAndFetch(int $id, array $attributes, array $whereAttributes = null): ?Model
    {
        if ($this->update($id, $attributes, $whereAttributes)) {
            return $this->find($id);
        }
        return null;
    }

    public function getAll(string|int $queryParam = null, array $whereAttributes = null): array|Collection
    {
        return Cache::remember($this->getTableName() . '_getAll', env('CACHE_EXPIRE_TIME'), function () use ($queryParam, $whereAttributes) {
            return $this->model->query()
                ->when(auth('sanctum')->check(), function ($query) {
                    $query->when(!request()->user('sanctum')->is_admin, function ($query) {
                        $query->where('user_id', request()->user('sanctum')->id);
                    });
                })
                ->when($whereAttributes != null, function ($query) use ($whereAttributes) {
                    $query->where($whereAttributes);
                })
                ->get();
        });

    }

    /**
     * @param string $attributeName
     * @param int $attributeId
     * @param array|null $whereAttributes
     * @return Model|null
     */
    public function findByForeignId(string $attributeName, int $attributeId, array $whereAttributes = null): ?Model
    {
        return $this->model
            ->query()
            ->where($attributeName . '_id', $attributeId)
            ->when($whereAttributes != null, function ($query) use ($whereAttributes) {
                $query->where($whereAttributes);
            })
            ->first();
    }

    /**
     * @param string $searchKey
     * @return mixed
     */
    public function search(string $searchKey): mixed
    {
        return $this->model
            ->query()
            ->where('title', 'LIKE', "%" . $searchKey . "%")
            ->orWhere('description', 'LIKE', "%" . $searchKey . "%")
            ->orWhere('slug', 'LIKE', "%" . $searchKey . "%")
            ->orWhereHas('categories', function (Builder $query) use ($searchKey) {
                $query->where('name', 'LIKE', "%" . $searchKey . "%")
                    ->orWhere('slug', 'LIKE', "%" . $searchKey . "%");
            })
            ->orWhereHas('tags', function (Builder $query) use ($searchKey) {
                $query->where('name', 'LIKE', "%" . $searchKey . "%")
                    ->orWhere('slug', 'LIKE', "%" . $searchKey . "%");
            });
    }


}

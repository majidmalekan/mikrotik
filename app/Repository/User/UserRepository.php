<?php

namespace App\Repository\User;

use App\Models\User;
use App\Repository\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function firstOrCreate(array $attributes): Model
    {
        $this->clearCache('index');
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
        return Cache::remember($this->getTableName() . '_index_' . $request->user()->id . $request->get('page', 1), env('CACHE_EXPIRE_TIME'), function () use ($request, $perPage) {
            return $this->model->query()
                ->when($request->has('search'), function ($query) use ($request) {
                    $query->where('phone', '=', $request->get('search'));
                })
                ->orderBy($request->get('sort', 'id'), $request->get('direction', 'DESC'))
                ->paginate($perPage, '*', '', $request->get('page', 1));
        });
    }
}

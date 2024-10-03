<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait CacheRepositoryTrait
{
    public function clearCache($key, $id = ''): void
    {
        if ($id != '') {
            Cache::forget($this->getTableName() . '_' . $key . '_' . (auth('sanctum')->check() && request()->user('sanctum')->id != $id ? request()->user('sanctum')->id . $id : $id));
        }
        Cache::forget($this->getTableName() . '_index_');
        for ($i = 1; $i <= $this->getLastPage(); $i++) {
            $newKey = $this->getTableName() . '_' . ($key == "index" ? $key : "index") . '_' . (auth('sanctum')->check() && !auth('sanctum')->user()->is_admin ? $i . request()->user('sanctum')->id : $i);
            if (Cache::has($newKey)) {
                Cache::forget($newKey);
            } else {
                break;
            }
        }
        $this->clearCacheGetAll('getAll');
        $this->clearCacheGetAll($key);
    }

    public function clearCacheGetAll($key): void
    {
        Cache::forget($this->getTableName() . '_' . $key);
        if (request()->user()) {
            Cache::forget($this->getTableName() . '_' . $key . request()->user()->id);
        }
    }

    public function clearAllCache(): void
    {
        Cache::clear();
    }
}

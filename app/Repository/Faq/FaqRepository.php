<?php

namespace App\Repository\Faq;

use App\Enums\UserRoleEnum;
use App\Models\FAQ;
use App\Repository\BaseRepository;
use Dotenv\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    public function __construct(FAQ $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string|int|null $queryParam
     * @return array|Collection
     */
    public function getAll(string|int $queryParam = null): array|Collection
    {
        return $this->model
            ->query()
            ->get();
    }
}

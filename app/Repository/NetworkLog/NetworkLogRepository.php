<?php

namespace App\Repository\NetworkLog;

use App\Models\NetworkLog;
use App\Repository\BaseRepository;

class NetworkLogRepository extends BaseRepository implements NetworkLogRepositoryInterface
{
    public function __construct(NetworkLog $model)
    {
        parent::__construct($model);
    }
}

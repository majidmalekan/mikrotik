<?php

namespace App\Service;

use App\Repository\NetworkLog\NetworkLogRepositoryInterface;

class NetworkLogService extends BaseService
{
    public function __construct(NetworkLogRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}

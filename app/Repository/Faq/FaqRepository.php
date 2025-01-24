<?php

namespace App\Repository\Faq;

use App\Models\FAQ;
use App\Repository\BaseRepository;
use Dotenv\Repository\RepositoryInterface;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    public function __construct(FAQ $model)
    {
        parent::__construct($model);
    }
}

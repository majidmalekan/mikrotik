<?php

namespace App\Service;

use App\Repository\Faq\FaqRepositoryInterface;

class FaqService extends BaseService
{
    public function __construct(FaqRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }
}

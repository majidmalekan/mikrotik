<?php

namespace App\Service;

use App\Repository\Ticket\TicketRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class TicketService extends BaseService
{
    public function __construct(TicketRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getRootTickets(Request $request): LengthAwarePaginator
    {
        return $this->repository->getRootTickets($request);
    }

    /**
     * @param int $ticketId
     * @return mixed
     */
    public function getTicketChildren(int $ticketId): mixed
    {
        return $this->repository->getTicketChildren($ticketId);
    }

    /**
     * @param int $ticketId
     * @return mixed
     */
    public function findTicketParent(int $ticketId): mixed
    {
        return $this->repository->findTicketParent($ticketId);
    }


    /**
     * @param int $ticketId
     * @return mixed
     */
    public function getTicketDescendants(int $ticketId): mixed
    {
        return $this->repository->getTicketDescendants($ticketId);
    }

    public function getTicketAncestors(int $ticketId){
        return  $this->repository->getTicketAncestors($ticketId);
    }

    public function getAllChildrenByParentId($parentId): \Illuminate\Database\Eloquent\Collection|array
    {
        return  $this->repository->getAllChildrenByParentId($parentId);
    }
}

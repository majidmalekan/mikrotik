<?php

namespace App\Repository\Ticket;

use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Kalnoy\Nestedset\Collection;

interface TicketRepositoryInterface
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getRootTickets(Request $request): LengthAwarePaginator;

    /**
     * @param int $ticketId
     * @return Collection|null
     */
    public function getTicketChildren(int $ticketId): ?Collection;

    /**
     * @param int $ticketId
     * @return Ticket|null
     */
    public function findTicketParent(int $ticketId): ?Ticket;

    /**
     * @param int $ticketId
     * @return Collection|null
     */
    public function getTicketDescendants(int $ticketId): ?Collection;

    /**
     * @param int $ticketId
     * @return Collection|null
     */
    public function getTicketAncestors(int $ticketId): ?Collection;

    /**
     * @param $parentId
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getAllChildrenByParentId($parentId): \Illuminate\Database\Eloquent\Collection|array;
}

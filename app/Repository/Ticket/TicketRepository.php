<?php

namespace App\Repository\Ticket;

use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Repository\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Kalnoy\Nestedset\Collection;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */

    public function getRootTickets(Request $request): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->when($request->user()->role==UserRoleEnum::User()->value, function (Builder $builder) use ($request) {
                $builder->where('user_id_from', $request->user()->id);
            })
            ->orderByDesc('updated_at')
            ->whereIsRoot()
            ->paginate($request->get('perPage'), '*', '', $request->get('page'));
    }


    /**
     * @param int $ticketId
     * @return Collection|null
     */
    public function getTicketChildren(int $ticketId): ?Collection
    {
        return $this->model->query()
            ->with('children')
            ->where('id', $ticketId)
            ->first()
            ->children;
    }


    /**
     * @param int $ticketId
     * @return Ticket|null
     */
    public function findTicketParent(int $ticketId): ?Ticket
    {
        return $this->model->query()->with('parent')
            ->where('id', $ticketId)
            ->firstOrFail()
            ->parent;
    }

    /**
     * @param int $ticketId
     * @return Collection|null
     */
    public function getTicketDescendants(int $ticketId): ?Collection
    {
        return $this->model
            ->query()->with('descendants')
            ->where('id', $ticketId)
            ->firstOrFail()
            ->descendants
            ->toTree();
    }

    /**
     * @param int $ticketId
     * @return Collection|null
     */
    public function getTicketAncestors(int $ticketId): ?Collection
    {
        return $this->model->query()->with('ancestors')
            ->where('id', $ticketId)
            ->firstOrFail()
            ->ancestors
            ->toTree();
    }

    /**
     * @param Request $request
     * @param int $perPage
     * @param array|null $whereAttributes
     * @return LengthAwarePaginator
     */
    public function index(Request $request, int $perPage, array $whereAttributes = null): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('user_id_to', $request->user()->id)
            ->when($request->user()->role==UserRoleEnum::Admin()->value, function ($query) use ($request) {
                $query->orWhere('user_id_to', null);
            })
            ->when($whereAttributes != null, function ($query) use ($whereAttributes) {
                $query->where($whereAttributes);
            })
            ->orderByDesc('updated_at')
            ->whereIsRoot()
            ->paginate($perPage, '*', '', $request->get('page'));
    }

    /**
     * @param $parentId
     * @return \Illuminate\Database\Eloquent\Collection|array
     */
    public function getAllChildrenByParentId($parentId): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->model
            ->query()
            ->where('parent_id', $parentId)
            ->get();
    }

    /**
     * @param int $id
     * @param array|null $whereAttributes
     * @return Model|null
     */
    public function show(int $id, array $whereAttributes = null): ?Model
    {
        return $this->model
            ->query()
            ->findOrFail($id);
    }
}

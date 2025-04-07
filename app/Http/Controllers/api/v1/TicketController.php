<?php

namespace App\Http\Controllers\api\v1;

use App\Enums\StatusTicketEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Notifications\SendSmsNotification;
use App\Service\TicketService;
use App\Traits\MustVerifyContact;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;

class TicketController extends Controller
{
    use Notifiable,MustVerifyContact;
    public function __construct(protected TicketService $ticketService)
    {
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $tickets = $this->ticketService->getRootTickets($request);
        return view('Auth.Ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('Auth.Ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        try {
            if ($request->has('parent_id')) {
                $parentTicket = $this->ticketService->find($request->post('parent_id'));
                $inputs['parent_id'] = $request->post('parent_id');
                $inputs["user_id_to"] = ($parentTicket->user_id_from === auth()->user()->id ? $parentTicket->user_id_to : $parentTicket->user_id_from);
                $inputs["department"] = $parentTicket->department;
                $inputs["title"] = $parentTicket->title;
                $inputs['priority'] = $parentTicket->priority;
            } else {
                $inputs = $request->only(['title', 'description', 'priority', 'department']);
            }
            $inputs["user_id_from"] = auth()->user()->id;
            $inputs["status"] = StatusTicketEnum::Pending()->value;
            $this->ticketService->create($inputs);
            $this->notify(new SendSmsNotification(3,$this->getAdminPhoneNumber()));
            $this->notify(new SendSmsNotification(4,auth()->user()->phone));
            return redirect()
                ->route('index-ticket-user')
                ->with('success', 'تیکت با موفقیت اضافه شد.');
        } catch (\Exception $exception) {
            return back()->withErrors('مشکلی پیش آمده است.');
        }

    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return Factory|View|Application
     */
    public function show(string $id): Factory|View|Application
    {
        $ticket = $this->ticketService->show($id);
        return view('Auth.Ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return View|Factory|Application
     */
    public function edit(string $id): View|Factory|Application
    {
        $ticket = $this->ticketService->show($id);
        return view('Auth.Ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTicketRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateTicketRequest $request, string $id): RedirectResponse
    {
        if ($request->input('status') == StatusTicketEnum::Closed()->value && $this->ticketService->find($id)?->parent_id == null)
            $inputs["status"] = StatusTicketEnum::Closed()->value;
        else {
            $inputs = $request->only(['description']);
        }
        $this->ticketService->updateAndFetch($id, $inputs);
        return redirect()
            ->route('show-ticket-user')
            ->with('success', 'تیکت با موفقیت اضافه شد.');
    }
}

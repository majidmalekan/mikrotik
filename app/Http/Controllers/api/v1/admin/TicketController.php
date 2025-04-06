<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Ticket\UpdateTicketRequest;
use App\Service\TicketService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(protected TicketService $ticketService){}

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tickets = $this->ticketService->index($request);
        return view('Admin.Ticket.index', compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function edit(string $id)
    {
        $ticket = $this->ticketService->show($id);
        return view('Admin.Ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTicketRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateTicketRequest $request, string $id)
    {
        $inputs = $request->except(['_token']);
        $this->ticketService->updateAndFetch($id, $inputs);
        return redirect()->route('edit-ticket')->with('success', 'تیکت با موفقیت ویرایش شد.');
    }
}

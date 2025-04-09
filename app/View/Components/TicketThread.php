<?php

namespace App\View\Components;

use App\Models\Ticket;
use Closure;
use Illuminate\View\Component;

class TicketThread extends Component
{
    public Ticket $ticket;

    public function __construct( Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function render(): \Illuminate\View\View|Closure|string
    {
        return view('components.ticket-thread');
    }
}

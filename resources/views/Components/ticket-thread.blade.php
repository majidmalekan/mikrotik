@php use App\Enums\DepartmentTicketEnum;use App\Enums\PriorityTicketEnum; @endphp
@props(['ticket'])

<div class="mb-4">
    {{-- Align message based on user/admin --}}
    <div class="flex {{ $ticket?->user_id_from == auth()->user()?->id ? 'justify-start' : 'justify-end' }}">
        <div class="max-w-md px-4 py-2 rounded-lg shadow
            {{ $ticket->user_id_from == auth()->user()?->id ? 'bg-blue-100 text-right text-blue-800' : 'bg-gray-200 text-right text-gray-800' }}">
            <p class="text-sm whitespace-pre-line">{{ $ticket->description }}</p>
            <small class="block mt-2 text-xs text-gray-500">{{ $ticket->created_at }}</small>
        </div>
    </div>

    {{-- Render children recursively --}}
    @foreach($ticket->children as $child)
        <x-ticket-thread :ticket="$child"/>
    @endforeach
</div>

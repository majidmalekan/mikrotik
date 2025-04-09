@php use App\Enums\DepartmentTicketEnum;use App\Enums\PriorityTicketEnum;use App\Enums\StatusTicketEnum;use App\Enums\UserRoleEnum; @endphp
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">

            <!-- عنوان -->
            <div class="bg-white border rounded shadow p-4 flex flex-col items-start">
                <span class="text-gray-500 mb-1">عنوان تیکت:</span>
                <span class="font-semibold text-gray-800">{{ $ticket->title }}</span>
            </div>

            <!-- وضعیت -->
            <div class="bg-white border rounded shadow p-4 flex flex-col items-start">
                <span class="text-gray-500 mb-1">وضعیت:</span>
                <span class="font-semibold
                @php
                    echo match($ticket->status) {
                        'pending' => 'text-yellow-600',
                        'closed' => 'text-red-600',
                        'answered' => 'text-green-600',
                        default => 'text-gray-600',
                    };
                @endphp">
                {{ StatusTicketEnum::{ucfirst($ticket->status)}()->label }}
            </span>
            </div>

            <!-- اولویت -->
            <div class="bg-white border rounded shadow p-4 flex flex-col items-start">
                <span class="text-gray-500 mb-1">اولویت تیکت:</span>
                <span class="font-semibold text-red-700">
                {{ PriorityTicketEnum::{ucfirst($ticket->priority)}()->label }}
            </span>
            </div>

            <!-- دپارتمان -->
            <div class="bg-white border rounded shadow p-4 flex flex-col items-start">
                <span class="text-gray-500 mb-1">دپارتمان:</span>
                <span class="font-semibold text-yellow-700">
                {{ DepartmentTicketEnum::{ucfirst($ticket->department)}()->label }}
            </span>
            </div>

        </div>
    </div>

    <div class="max-w-3xl mx-auto my-5 p-6 bg-white rounded shadow">

        <h1 class="text-xl font-bold mb-4">پاسخ‌های تیکت</h1>

        {{-- Render the full thread --}}
        <x-ticket-thread :ticket=" $ticket "/>

        {{-- Only allow reply to the last child --}}
        @php
            function getLastChild($ticket) {
                return $ticket->children->isEmpty() ? $ticket : getLastChild($ticket->children->last());
            }
            $lastTicket = getLastChild($ticket);
        @endphp
        @if($ticket->status!=StatusTicketEnum::Closed()->value)

        <div class="mt-8 border-t pt-4">
            <form method="POST" action="{{ route('tickets.store') }}">
                @csrf
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">پاسخ جدید</label>
                <textarea name="description" id="description" rows="10"
                          class="w-full p-3 border rounded" placeholder="متن خود را بنویسید..." required></textarea>
                <input value="{{ $lastTicket->id }}" name="parent_id" hidden>
                <input value="{{ $ticket->id }}" name="root_id" hidden>
                <input value="{{ $lastTicket->priority }}" name="priority" hidden>
                <input value="{{ $lastTicket->department }}" name="department" hidden>
                <input value="{{ $lastTicket->title }}" name="title" hidden>
                <input
                    value="{{auth()->user()->role==UserRoleEnum::User()->value? StatusTicketEnum::Pending()->value :StatusTicketEnum::Answered()->value }}"
                    name="title" hidden>
                <button type="submit"
                        class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ارسال پاسخ
                </button>
            </form>
        </div>
        @endif
    @if( auth()->user()?->role==UserRoleEnum::User()->value && $ticket->status!=StatusTicketEnum::Closed()->value)
            <div class="mt-8 border-t pt-4">
                <form method="POST" action="{{ route('tickets.close') }}">
                    @csrf
                    <input
                        value="{{ StatusTicketEnum::Closed()->value }}"
                        name="title" hidden>
                    <input value="{{ $ticket->id }}" name="root_id" hidden>
                    <button type="submit"
                            class="mt-3 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        بستن تیکت
                    </button>
                </form>
            </div>
        @endif

    </div>
@endsection
@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {
                language: 'fa'
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush

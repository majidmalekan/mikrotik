@php use App\Enums\DepartmentTicketEnum;use App\Enums\PriorityTicketEnum;use App\Enums\StatusTicketEnum; @endphp
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <!-- Ticket Info -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-customBlue">{{ $ticket->title }}</h2>
        <p class="text-sm text-gray-500 mt-1">وضعیت:
            <span class="@php
                echo match($ticket->status) {
                    'pending' => 'text-ticketStatus-pending',
                    'closed' => 'text-ticketStatus-closed',
                    'answered' => 'text-ticketStatus-answered',
                    default => 'text-gray-500'
                };
            @endphp font-semibold">
                {{ StatusTicketEnum::{ucfirst($ticket->status)}()->label }}
            </span>
        </p>
        <p class="mt-4 text-gray-700">{{ DepartmentTicketEnum::{ucfirst($ticket->department)}()->label }}</p>
        <p class="mt-4 text-gray-700">{{ PriorityTicketEnum::{ucfirst($ticket->priority)}()->label }}</p>
        <p class="mt-4 text-gray-700">{{ $ticket->description }}</p>
    </div>

    <!-- Answers Section -->
    <h3 class="text-xl font-semibold mb-4 border-b pb-2">پاسخ‌ها</h3>

    @forelse ( $ticket->children as $answer)
        <div class="mb-6 border rounded p-4 bg-gray-50">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm text-gray-700 font-medium">{{ $answer->user_name ?? 'پشتیبانی' }}</span>
                <span class="text-sm text-gray-500">{{ jdate($answer->created_at)->format('Y/m/d H:i') }}</span>
            </div>
            <div class="text-gray-800 leading-relaxed">
                {!! nl2br(e($answer->description)) !!}
            </div>
        </div>
    @empty
        <p class="text-gray-500">هنوز پاسخی برای این تیکت ثبت نشده است.</p>
    @endforelse
</div>

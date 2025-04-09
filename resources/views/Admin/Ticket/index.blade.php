@php use App\Enums\DepartmentTicketEnum;use App\Enums\PriorityTicketEnum;use App\Enums\StatusTicketEnum; @endphp
@extends('Layouts.app')
@section('content')
    <main class="flex-1 p-6 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl  mb-6 text-customBlue">لیست تیکت ها</h2>
            <div class="overflow-x-auto mt-5">
                <table class="min-w-full bg-white rounded-lg shadow-md">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-center">ردیف</th>
                        <th class="py-3 px-6 text-center">نام و نام خانوادگی</th>
                        <th class="py-3 px-6 text-center">شماره تماس</th>
                        <th class="py-3 px-6 text-center">عنوان</th>
                        <th class="py-3 px-6 text-center">اولویت</th>
                        <th class="py-3 px-6 text-center">دپارتمان</th>
                        <th class="py-3 px-6 text-center">وضعیت</th>
                        <th class="py-3 px-6 text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @php $counter = 1; @endphp
                    @foreach ( $tickets as $ticket)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $counter }}</td>
                            <td class="py-3 px-6 text-center">{{ $ticket?->user?->name != null ?  $ticket?->user?->name : "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ $ticket?->user?->phone != null ? $ticket?->user?->phone : "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ $ticket?->title != null ? $ticket?->title : "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ $ticket?->priority != null ?PriorityTicketEnum::{ ucfirst($ticket?->priority)}()->label: "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ $ticket?->department != null ?DepartmentTicketEnum::{ ucfirst($ticket?->department)}()->label: "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">{{ $ticket?->status != null?StatusTicketEnum::{ucfirst($ticket?->status)}()->label: "وارد نشده" }}</td>
                            <td class="py-3 px-6 text-center">
                                <a href="{{ route('tickets.show', $ticket?->id) }}">
                                    <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                                        نمایش
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @php $counter++; @endphp
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-6 flex items-center justify-center gap-3">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection

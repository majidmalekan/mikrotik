@php use App\Enums\DepartmentTicketEnum;use App\Enums\PriorityTicketEnum; @endphp
@extends('Layouts.app')
@section('content')
<main class="flex-1 p-6 bg-white">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">ویرایش تیکت</h2>
    <div class="shadow-md rounded px-8 pt-6 pb-8 w-full">
        @if ( $errors->any())
            <div class="fixed top-5 right-5 space-y-2">
                @foreach ( $errors->all() as $error)
                    <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                        <span class="mr-2">⚠️</span>
                        <span>{{ $error }}</span>
                        <button onclick="this.parentElement.remove()" class="ml-auto text-white font-bold">✖</button>
                    </div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('tickets.update', $ticket?->id) }}">
            @csrf
            <!-- Name Field -->
            <div class="flex w-full">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">عنوان تیکت</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $ticket->title) }}"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           required>
                </div>
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="department">دپارتمان تیکت
                        <select
                            name="department"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                            required>
                            @foreach ( DepartmentTicketEnum::toArray() as $department)
                                <option
                                    value="{{ $department["value"] }}" {{ $ticket->department==$department["value"] ? 'selected' : '' }}>{{ $department["label"] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>

            <!-- Email Field -->

            <div class="flex w-full mt-4">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="priority">اولویت تیکت
                        <select
                            name="priority"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                            required>
                            @foreach ( PriorityTicketEnum::toArray() as $priority)
                                <option
                                    value="{{ $priority["value"] }}" {{ $ticket->priority==$priority["value"] ? 'selected' : '' }}>{{ $priority["label"] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <!-- Role Field -->
            </div>
            <div class="flex w-full mt-4">
                <div class="w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">توضیحات</label>
                    <textarea type="text" name="description" id="description"
                              rows="10"
                              class="mt-1 block w-full px-3 py-2 bg-white border
                               border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500
                                focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                    >
                        {{ old('description', $ticket->description) }}
                    </textarea>
                </div>
            </div>
            <div class="flex items-center mt-4">
                <button
                    class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200"
                    type="submit">
                    اعمال تغییرات
                </button>
            </div>
        </form>
    </div>
</main>
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

@extends('Layouts.app')
@section('content')
<div class="flex-grow flex  items-center flex-col  mt-3 px-4">
    <div class="text-center a w-full max-w-sm">
        @if ($errors->any())
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
        <div class="mt-5">
            <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="mx-auto" style="height: 200px">
        </div>
        <div class="bg-white shadow-custom rounded-lg p-5 max-w-sm mx-auto mt-10 w-3/4 lg:w-full md:w-full">
            <p class="text-gray-500 mt-2">میزان حجم مصرفی شما</p>
            <p class="mt-5">
                {{ $user['traffic'] }} مگابایت
            </p>
            <p class="mt-2">از</p>
            <p class="mt-2">
                {{ !$user->is_vip? $user["traffic_limit"] . " گیگابایت" : "بی نهایت" }}
            </p>

        </div>
    </div>
    <hr>
    <div class="bg-white shadow-custom rounded-lg p-5 max-w-sm mx-auto mt-32 w-3/4 lg:w-full md:w-full">
        <h2 class="text-lg font-bold text-customBlue mb-4">سوالات متداول</h2>
        @forelse ( $faqs as $faq)
            <div x-data="{ open: false }" class="border-b border-gray-200 py-2">
                <button @click="open = !open"
                        class="w-full text-right font-semibold text-gray-800 hover:text-customBlue focus:outline-none flex justify-between items-center">
                    <span>{{ $faq->question }}</span>
                    <svg :class="{ 'rotate-180': open }" class="h-4 w-4 transition-transform" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open" x-transition class="text-sm text-gray-600 mt-2">
                    {{ $faq->answer }}
                </div>
            </div>
        @empty
            <p class="text-gray-400 text-sm">سوالی ثبت نشده است.</p>
        @endforelse
    </div>
</div>
<!-- Accordion: FAQ Section -->
@endsection

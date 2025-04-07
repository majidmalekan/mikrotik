<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه کنسول</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white flex flex-col  justify-center min-h-screen font-IRANSans ">
@include('Components.header') <!-- Include the sidebar -->

<div class="flex-grow flex justify-center items-start mt-8 px-4">
    <div class="text-center w-full max-w-sm">
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
</div>
</body>

</html>

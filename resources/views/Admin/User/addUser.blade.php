<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافه کردن کاربر</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex min-h-screen">
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">اضافه کردن کاربر</h2>
    @if ($errors->any())
        <div class="fixed top-5 right-5 space-y-2">
            @foreach ($errors->all() as $error)
                <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                    <span class="mr-2">⚠️</span>
                    <span>{{ $error }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-white font-bold">✖</button>
                </div>
            @endforeach
        </div>
    @endif
    <form method="POST" action="{{ route('store-user') }}">
    @csrf
    <!-- Name Field -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">نام و نام خانوادگی</label>
            <input type="text" name="name" id="name"
                   class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">ایمیل</label>
            <input type="email" name="email" id="email"
                   class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">شماره تماس</label>
            <input type="text" name="phone" id="phone"
                   class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <!-- Role Field -->
{{--        <div class="mb-4">--}}
{{--            <label class="block text-gray-700 text-sm font-bold mb-2" for="role">نقش</label>--}}
{{--            <input type="text" name="role" id="role"--}}
{{--                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>--}}
{{--        </div>--}}

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="traffic_limit">میزان حجم مصرفی</label>
            <input type="text" name="traffic_limit" id="traffic_limit"
                   class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200"
                type="submit">
               اضافه کردن کاربر
            </button>
        </div>
    </form>
</div>
</body>

</html>

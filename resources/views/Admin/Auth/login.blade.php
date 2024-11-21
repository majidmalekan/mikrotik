<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen font-IRANSans ">
<div class="mb-6">
    <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="mx-auto w-20 h-20">
    <h1 class="text-blue-800 font-bold text-xl mt-4">پارک علم و فناوری</h1>
</div>
    <div class="w-full max-w-md">
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
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
            id="md-form"
            autocomplete="off"
            method="post"
            action="{{ route('login-admin')}}">
            @csrf
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">ورود به بخش مدیریت</h2>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2 font-IRANSans " for="username">
                    نام کاربری
                </label>
                <input class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username" type="text" placeholder="نام کاربری خود را وارد کنید">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    گذرواژه
                </label>
                <input class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" type="text" placeholder="گذرواژه خود را وارد کنید">
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200"
                    type="submit">
                        ورود
                </button>
            </div>
        </form>
    </div>
</body>

</html>

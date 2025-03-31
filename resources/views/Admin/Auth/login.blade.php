<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white flex flex-col items-center min-h-screen font-IRANSans ">
<div class="flex flex-col items-center">
    <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="mx-auto" style="height: 200px">
    <h1 class="text-customBlue font-bold text-xl mt-5">ناحیه نوآوری شریف</h1>
</div>
    <div class="max-w-md w-3/4 lg:w-full md:w-full">
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
        <form class="bg-white shadow-custom rounded px-8 pt-6 pb-8 mb-4 mt-5"
            id="md-form"
            autocomplete="off"
            method="post"
            action="{{ route('login-admin')}}">
            @csrf
            <h2 class="text-2xl font-semibold mb-6 mt-2 text-gray-800 text-center">ورود</h2>
            <div class="mb-4">
                <label class="block text-gray-500 text-sm font-bold mb-2 font-IRANSans " for="username">
                    نام کاربری
                </label>
                <input class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username" type="text" placeholder="نام کاربری خود را وارد کنید">
            </div>
            <div class="mb-4">
                <label class="block text-gray-500 text-sm font-bold mb-2" for="password">
                    گذرواژه
                </label>
                <input class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" type="password" placeholder="گذرواژه خود را وارد کنید">
            </div>
                <button
                    class="bg-customBlue text-white p-6 py-2 rounded transition duration-200"
                    type="submit">
                    ورود به سیستم
                </button>
        </form>
    </div>
</body>

</html>

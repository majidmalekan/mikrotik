<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen font-IRANSans ">
<div class="text-center">
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
    <div class="mb-6">
        <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="mx-auto w-20 h-20">
        <h1 class="text-blue-800 font-bold text-xl mt-4">پارک علم و فناوری</h1>
    </div>
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-sm mx-auto">
        <h2 class="text-gray-800 text-lg font-semibold mb-2">منطقه نوآوری شریف</h2>
        <p class="text-gray-500 mb-4">برای دسترسی به اینترنت اطلاعات خود را وارد کنید</p>
        <form id="md-form"
              autocomplete="off"
              method="post"
              action="{{ route('login') }}">
        @csrf
        <!-- Input field -->
            <label for="phone">
                <input type="text" placeholder="شماره موبایل"
                       name="phone"
                       class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500">
            </label>

            <!-- Submit Button -->
            <button
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200"
                type="submit">
                ورود به سیستم
            </button>
        </form>

    </div>
</div>
</body>

</html>

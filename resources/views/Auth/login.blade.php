<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ورود</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white flex justify-center min-h-screen font-IRANSans ">
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
    <div class="mt-5">
        <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="mx-auto" style="height: 200px">
    </div>
    <div class="bg-white shadow-custom rounded-lg p-8 max-w-sm mx-auto mt-10 w-3/4 lg:w-full md:w-full">
        <h2 class="text-gray-800 text-lg font-semibold">منطقه نوآوری شریف</h2>
        <p class="text-gray-700 mt-4">برای دسترسی به اینترنت اطلاعات خود را وارد کنید</p>
        <form id="md-form"
              class="mt-10"
              autocomplete="off"
              method="post"
              action="{{ route('login-verify') }}">
        @csrf
        <!-- Input field -->
            <label for="phone" class="flex text-gray-500">
                شماره موبایل
            </label>
            <input
                   type="text"
                   name="phone"
                   class="w-full p-3 border border-gray-300 rounded mb-4 text-right focus:outline-none focus:ring-2 focus:ring-blue-500">
            <!-- Submit Button -->
            <button
                class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200"
                type="submit">
                ورود به سیستم
            </button>
        </form>

    </div>
</div>
</body>

</html>

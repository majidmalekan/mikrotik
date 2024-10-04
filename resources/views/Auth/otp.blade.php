<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه رمز موقت</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen font-IRANSans ">
<div class="w-full max-w-md">
    @if ($errors->has('phone'))
        <div class="alert alert-danger">
            {{ $errors->first('otp') }}
        </div>
    @endif
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4"
          id="md-form"
          autocomplete="off"
          method="post"
          action="{{ route('otp') }}">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">کد موقت</h2>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="otp">
                کد موقت اعتبار سنجی
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="otp" name="otp" type="text" placeholder="کد موقت خود را وارد کنید">
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                ورود
            </button>
        </div>
    </form>
</div>
</body>

</html>

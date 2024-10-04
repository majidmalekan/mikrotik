<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش کاربر</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mt-10">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">ویرایش کاربر</h2>
        <form method="POST" action="{{ route('update-user') }}">
            @csrf
            <!-- Name Field -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">نام و نام خانوادگی</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <!-- Email Field -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">ایمیل</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">شماره تماس</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <!-- Role Field -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">نقش</label>
                <input type="text" name="role" id="role" value="{{ old('role', $user->role) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div> 
            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    ویرایش
                </button>
                <a href="/users" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    انصراف
                </a>
            </div>
        </form>
    </div>
</body>

</html>
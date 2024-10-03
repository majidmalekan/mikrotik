<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>جدول لیست کاربران</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">لیست کاربران</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ردیف</th>
                        <th class="py-3 px-6 text-left">نام</th>
                        <th class="py-3 px-6 text-left">شماره تماس</th>
                        <th class="py-3 px-6 text-center">نوع کاربر</th>
                        <th class="py-3 px-6 text-center">عملیات</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->phone }}</td>
                        <td class="py-3 px-6 text-center">{{ $user->is_vip }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('edit-user', $user->id) }}">
                                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Edit</button>
                            </a>
                            <a href="{{ route('delete-user', $user->id) }}">
                                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 ml-2">Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
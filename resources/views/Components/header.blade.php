<header class="bg-customBlue text-white px-6 py-4 flex justify-between items-center shadow-md">
    <div class="text-lg font-bold">ناحیه نوآوری شریف</div>
    <div class="flex space-x-4 space-x-reverse">
        <a href="{{ route('tickets.index') }}"
           class="bg-white px-4 py-2 rounded-lg font-semibold text-black hover:bg-gray-100 transition">
            تیکت‌ها
        </a>
        <a href="{{ route('logout') }}"
           class="bg-red-500 px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
            خروج
        </a>
    </div>
</header>

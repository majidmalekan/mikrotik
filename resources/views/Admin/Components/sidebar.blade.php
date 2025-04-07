@php use App\Enums\UserRoleEnum; @endphp
<aside class="w-64 bg-gray-800 text-gray-100 p-4">
    <div class="mb-6">
        <img src="{{ asset('Image/logo.jpg') }}" alt="Logo" class="w-30 h-30 mx-auto">
    </div>
    <nav>
        <ul>
            @if( in_array(auth()->user()?->role, [UserRoleEnum::Admin()->value, UserRoleEnum::Supervisor()->value]))
                <li class="mb-4">
                    <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">مشاهده
                        کاربران</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('add-user') }}" class="block py-2 px-4 rounded hover:bg-gray-700">اضافه کردن
                        کاربر</a>
                </li>
            @endif
            @if( auth()->user()?->role== UserRoleEnum::Admin()->value )
                <li class="mb-4">
                    <a href="{{ route('index-faq') }}" class="block py-2 px-4 rounded hover:bg-gray-700">مشاهده سوالات
                        متداول</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('create-faq') }}" class="block py-2 px-4 rounded hover:bg-gray-700">اضافه کردن
                        سوالات متداول</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('network-logs.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">گزارشات
                        اتصال و مصرف</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('index-ticket') }}" class="block py-2 px-4 rounded hover:bg-gray-700">پشتیبانی</a>
                </li>
            @endif
        </ul>
    </nav>
</aside>

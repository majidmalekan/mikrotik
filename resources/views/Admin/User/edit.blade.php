@extends('Layouts.app')
@section('content')
<main class="flex-1 p-6 bg-white">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">ویرایش کاربر</h2>
    <div class="shadow-md rounded px-8 pt-6 pb-8 w-full">
        @if ( $errors->any())
            <div class="fixed top-5 right-5 space-y-2">
                @foreach ( $errors->all() as $error)
                    <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
                        <span class="mr-2">⚠️</span>
                        <span>{{ $error }}</span>
                        <button onclick="this.parentElement.remove()" class="ml-auto text-white font-bold">✖</button>
                    </div>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('update-user', $user?->id) }}">
            @csrf
            <!-- Name Field -->
            <div class="flex w-full">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">نام و نام خانوادگی</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           required>
                </div>
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">نام کاربری</label>
                    <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           required>
                </div>
            </div>

            <!-- Email Field -->

            <div class="flex w-full mt-4">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">شماره تماس</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                           readonly
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           required>
                </div>
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">ایمیل</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           required>
                </div>
                <!-- Role Field -->

            </div>
            <div class="flex w-full mt-4">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="traffic_limit">میزان حجم مصرفی
                        (گیگابایت)</label>
                    <input type="text" name="traffic_limit" id="traffic_limit"
                           class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                           value="{{ old('traffic_limit', $user->traffic_limit) }}"
                           required>
                </div>
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="is_vip">
                        کاربر ویژه
                        <select
                            name="is_vip"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                            required>
                            <option value="1" {{ $user->is_vip ? 'selected' : '' }}>آری</option>
                            <option value="0" {{ !$user->is_vip ? 'selected' : '' }}>خیر</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="flex w-full mt-4">
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">وضعیت
                        <select
                            name="status"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                            required>
                            <option value="active" {{ $user->status=="active" ? 'selected' : '' }}>فعال</option>
                            <option value="disable" {{ $user->status=="disable" ? 'selected' : '' }}>غیرفعال</option>
                        </select>
                    </label>
                </div>
                <div class="w-1/2">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">نقش کاربر
                        <select
                            name="role"
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm md:w-1/2 lg:w-1/2"
                            required>
                            @foreach ( UserRoleEnum::toArray() as $role)
                                <option
                                    value="{{ $role["value"] }}" {{ $user->role == $role["value"] ? 'selected' : '' }}>{{ $role["label"] }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center mt-4">
                <button
                    class="p-6 mt-5 bg-customBlue text-white py-2 rounded transition duration-200"
                    type="submit">
                    اعمال تغییرات
                </button>
            </div>
        </form>
    </div>
</main>
@endsection

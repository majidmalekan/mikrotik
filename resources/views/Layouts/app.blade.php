@php use App\Enums\UserRoleEnum; @endphp
    <!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه کنسول</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('styles')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
</head>
@if( auth()->user() && auth()->user()->role==UserRoleEnum::User()->value)
    <body class="bg-white flex flex-col  justify-center min-h-screen font-IRANSans ">
    @include('Components.header')
@endif
@if( auth()->user() && in_array(auth()->user()?->role, [UserRoleEnum::Admin()->value, UserRoleEnum::Supervisor()->value]))
    <body class="bg-gray-100 flex justify-center min-h-screen">
    @include('Admin.Components.sidebar')
@endif
<main class="flex-grow bg-white">
    @yield('content')
</main>
    @if( auth()->user() && auth()->user()->role==UserRoleEnum::User()->value)
        @include('Components.footer')
    @endif

    @stack('scripts')
</body>
</html>

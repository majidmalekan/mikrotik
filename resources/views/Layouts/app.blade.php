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

<body class="bg-white flex flex-col  justify-center min-h-screen font-IRANSans ">
@if( auth()->user() && auth()->user()->role==UserRoleEnum::User()->value)
    @include('Components.header')
@endif
@if( auth()->user() && in_array(auth()->user()?->role, [UserRoleEnum::Admin()->value, UserRoleEnum::Supervisor()->value]))
    @include('Admin.Components.sidebar')
@endif
<main class="flex-grow">
    @yield('content')
</main>
@include('Components.footer')
@stack('scripts')
</body>
</html>

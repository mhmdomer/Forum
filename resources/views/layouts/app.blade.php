<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body>
    <div id="app" class="bg-indigo-100 text-gray-700">
        <alert message='{{ session('message') }}'></alert>
        @include('partials.navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>

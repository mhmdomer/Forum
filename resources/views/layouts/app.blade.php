<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body>
    <div id="app" class="bg-gray-200 text-gray-700">
        <alert message='{{ session('message') }}' level='{{ session('message-level') }}'></alert>
        @include('partials.navbar')
        <main class="py-4">
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
</body>
<script>
    window.App = {!!
        json_encode([
            'signedIn' => Auth::check(),
            'user' => Auth()->user()
        ])
    !!}
</script>
</html>

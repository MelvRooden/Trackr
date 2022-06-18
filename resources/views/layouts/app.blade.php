<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.inc.header')
</head>
<body>
    <div id="app">
        @include('layouts.inc.nav')

        <main class="py-4">
            @yield('content')
        </main>
        @include('layouts.inc.footer')
    </div>
</body>
</html>

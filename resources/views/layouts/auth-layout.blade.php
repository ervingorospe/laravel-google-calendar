<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Calendar App')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="//unpkg.com/alpinejs" defer></script>
        <!-- Styles / Scripts -->
        @vite('resources/css/app.css')
    </head>
    <body x-data="{ active: null }"class="antialiased bg-gray-100">
        <x-navbar />

        <main>
            <div>
                @yield('content')
            </div>
        </main>
    </body>
</html>

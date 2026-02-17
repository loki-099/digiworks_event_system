<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Cotabato DigiWork Expo 2026</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-16 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="pt-10">
                <a href="/">
                    <h1 class="text-2xl font-bold text-gray-950 dark:text-gray-50 text-center">@yield('name')</h1>
                </a>
            </div>

            <div class="w-full sm:max-w-lg mt-6 px-6 py-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                @yield('content')
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-950 min-h-screen flex flex-col font-["Instrument_Sans"]">

    <nav class="w-full p-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-xl font-bold dark:text-white">
                DigiWork Expo 2026
            </div>
            
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('attendee.dashboard') }}" class="text-sm font-medium dark:text-gray-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium dark:text-gray-300 hover:text-gray-600 dark:hover:text-white transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none transition">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="relative flex-grow flex flex-col items-center justify-center px-4 text-center py-20 bg-gray-900 overflow-hidden">
    
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/protruding-squares.svg') }}" 
                alt="Event Background" 
                class="w-full h-full object-cover object-center opacity-40">
            
            <div class="absolute inset-0 bg-linear-to-b from-transparent to-gray-100 dark:to-gray-950"></div>
        </div>

        <div class="relative z-10 flex flex-col items-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-white drop-shadow-lg">
                Cotabato DigiWork Expo 2026
            </h1>
            
            <p class="text-gray-200 max-w-2xl mb-10 text-lg drop-shadow-md">
                PlaceHolder 
            </p> <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="text-white bg-blue-700 hover:bg-blue-800 shadow-md font-medium rounded-lg text-base px-6 py-3 transition-all hover:scale-105">
                    Register Now
                </a>
                <a href="#about" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-50 font-medium rounded-lg text-base px-6 py-3 transition">
                    About the Event
                </a>
            </div>
        </div>
    </main>
    <section id="about" class="w-full bg-white dark:bg-gray-900 py-20 px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold dark:text-white mb-8 text-center md:text-left">About the Event</h2>
            
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <h3 class="text-xl font-semibold dark:text-blue-400 mb-3">What is DigiWork?</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        PlaceHolder
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold dark:text-blue-400 mb-3">Event Highlights</h3>
                    <ul class="text-gray-600 dark:text-gray-400 space-y-2">
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Blahhblahhh
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Testingtestinh
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> you can put shit here
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <footer class="p-8 text-center text-sm text-gray-500 dark:text-gray-600 border-t border-gray-200 dark:border-gray-800">
        &copy; {{ date('Y') }} Cotabato DigiWork Expo. All rights reserved.
    </footer>

</body>
</html>
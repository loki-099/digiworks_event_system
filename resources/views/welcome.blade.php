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
<body class="bg-gray-100 dark:bg-gray-950 min-h-screen flex flex-col font-['Instrument_Sans']">

    {{-- Fixed Nav: Removed 'absolute' so it doesn't block content --}}
    <nav class="w-full p-6 bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="text-xl font-bold dark:text-white">
                DigiWork Expo 2026
            </div>
            
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium dark:text-gray-300">Dashboard</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Main Split Layout --}}
    <main class="flex-grow flex flex-col md:flex-row">
        
        {{-- Left Side: The Poster with Poster-matching Colors --}}
        <div class="w-full md:w-1/2 bg-gradient-to-br from-[#d1e9ff] to-[#f0f7ff] dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-8 md:p-12">
            <div class="relative max-w-md lg:max-w-lg">
                <img src="{{ asset('images/landingPage.jpg') }}" 
                    alt="Cotabato DigiWork Expo 2026 Poster" 
                    class="w-full h-auto object-contain rounded-xl shadow-2xl transition-transform duration-500 hover:scale-[1.03]">
                
                {{-- Dynamic Glow matching poster blue --}}
                <div class="absolute -inset-4 bg-blue-400/20 blur-3xl rounded-full -z-10"></div>
            </div>
        </div>

        {{-- Right Side: Content & Registration --}}
        <div class="w-full md:w-1/2 flex flex-col items-center justify-center px-8 py-12 md:py-20 text-center md:text-left bg-white dark:bg-gray-950">
            <div class="max-w-xl">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 text-gray-900 dark:text-white leading-tight">
                    Cotabato DigiWork <span class="text-blue-600">Expo 2026</span>
                </h1>
                
                <p class="text-gray-600 dark:text-gray-400 mb-10 text-lg leading-relaxed">
                    A showcase of local digital innovation and technology. Join us at the 
                    <strong class="text-gray-900 dark:text-white">University of Southern Mindanao (USM)</strong> 
                    this March 2-4, 2026 for an immersive experience in the future of work.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <a href="{{ route('register') }}" 
                        class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 shadow-lg font-medium rounded-lg text-lg px-8 py-4 transition-all hover:scale-105 active:scale-95">
                        Register Now
                    </a>
                    <a href="#about" 
                        class="w-full sm:w-auto text-gray-900 bg-white border border-gray-300 hover:bg-gray-50 font-medium rounded-lg text-lg px-8 py-4 transition">
                        Learn More
                    </a>
                </div>

                {{-- Quick Info --}}
                <div class="mt-12 grid grid-cols-2 gap-6 border-t border-gray-100 dark:border-gray-800 pt-8">
                    <div>
                        <span class="block text-xs uppercase tracking-widest text-gray-500 mb-1">When</span>
                        <span class="text-sm font-semibold dark:text-gray-200">March 2 - 4, 2026</span>
                    </div>
                    <div>
                        <span class="block text-xs uppercase tracking-widest text-gray-500 mb-1">Where</span>
                        <span class="text-sm font-semibold dark:text-gray-200">Kabacan, Cotabato</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section id="about" class="w-full bg-gray-50 dark:bg-gray-900 py-24 px-4">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold dark:text-white mb-4">About the Event</h2>
                <div class="h-1.5 w-20 bg-blue-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-16">
                <div>
                    <h3 class="text-xl font-semibold dark:text-blue-400 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        What is DigiWork?
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-lg">
                        DigiWork Expo is the premier digital gathering in Cotabato, designed to bridge the gap between local talent and global technological trends. We bring together developers, students, and tech enthusiasts to explore the evolving landscape of digital careers and innovation.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-semibold dark:text-blue-400 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        Event Highlights
                    </h3>
                    <ul class="text-gray-600 dark:text-gray-400 space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center text-xs">✓</span>
                            <span>Connect with alumni and industry leaders from across Cotabato.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center text-xs">✓</span>
                            <span>Seamless entry via secure QR code registration system.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 flex items-center justify-center text-xs">✓</span>
                            <span>Explore digital workforce competitiveness expositions and specialized workshops.</span>
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
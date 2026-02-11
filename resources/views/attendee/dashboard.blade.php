@extends('layouts.guest')

@section('name', 'Successful Registration')

@section('content')
    <div class="flex flex-col items-center">
        <div class="flex items-center justify-center mb-6">{{ $qrcode }}</div>
        <p class="text-gray-950 dark:text-white text-center max-w-[400px] font-medium">Welcome to Cotabato DigiWork Expo 2026! Your registration was successful.</p>
        <p class="text-gray-900 dark:text-white/80 text-center max-w-[300px] text-sm mt-2 italic">Take a sceenshot of your QR Code that will be used for the attendance.</p>

    </div>

@endsection

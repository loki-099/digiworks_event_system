@extends('layouts.admin')

@section('title', 'Evaluations')

@section('content')

{{-- MAIN WRAPPER: Pushes content right of sidebar, below navbar, and applies dark background --}}
<div class="p-6 sm:ml-64 pt-24 min-h-screen bg-gray-900">

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-white">Event Evaluations</h1>
    </div>

    {{-- Card Container --}}
    <div class="bg-gray-800 rounded-xl shadow-lg p-6">

        {{-- Reviews --}}
        <div class="space-y-4">

            @foreach($evaluations as $evaluation)

            <div class="bg-gray-700/40 rounded-lg p-4">

                <div class="flex justify-between items-start">

                    {{-- Left --}}
                    <div class="flex gap-4">

                        {{-- Avatar --}}
                        <div class="w-10 h-10 rounded-full bg-gray-600 flex items-center justify-center font-bold text-white">
                            {{ strtoupper(substr($evaluation->attendee->name,0,1)) }}
                        </div>

                        <div>
                            {{-- Name --}}
                            <p class="text-white font-semibold">
                                {{ $evaluation->attendee->name }}
                            </p>
                            
                            {{-- Email --}}
                            <p class="text-xs text-gray-400 mb-1">
                                {{ $evaluation->attendee->email }}
                            </p>

                            {{-- Stars --}}
                            <div class="flex mt-1">
                                @for($i=1;$i<=5;$i++)
                                    <svg class="w-4 h-4 {{ $i <= $evaluation->rating ? 'text-yellow-400' : 'text-gray-500' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.974a1 1 0 00.95.69h4.178c.969 0 1.371 1.24.588 1.81l-3.385 2.46a1 1 0 00-.364 1.118l1.287 3.974c.3.921-.755 1.688-1.54 1.118l-3.385-2.46a1 1 0 00-1.175 0l-3.385 2.46c-.784.57-1.838-.197-1.539-1.118l1.287-3.974a1 1 0 00-.364-1.118L2.047 9.401c-.783-.57-.38-1.81.588-1.81h4.178a1 1 0 00.95-.69l1.286-3.974z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>

                    </div>

                    {{-- Date & Time --}}
                    <div class="text-right">
                        <span class="block text-sm text-gray-400">
                            {{ $evaluation->created_at->format('M d, Y') }}
                        </span>
                        <span class="block text-xs text-gray-500 mt-0.5">
                            {{ $evaluation->created_at->format('h:i A') }}
                        </span>
                    </div>

                </div>

                {{-- Comment --}}
                <p class="text-gray-300 mt-3 text-sm">
                    {{ $evaluation->comments ?? 'No comments provided.' }}
                </p>

            </div>

            @endforeach

            @if($evaluations->isEmpty())
                <p class="text-center text-gray-400">No evaluations available.</p>
            @endif

        </div>

    </div>

</div>

@endsection
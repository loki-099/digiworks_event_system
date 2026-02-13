@extends('layouts.guest')

@section('name', 'Event Evaluation')

@section('content')
    <div>
        {{-- Success message --}}
        @if(session('success'))
            <div class="p-4 mb-6 text-sm text-green-700 bg-green-100 border border-green-400 rounded-lg dark:bg-green-900 dark:text-green-200 dark:border-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- General message --}}
        @if(session('message'))
            <div class="p-4 mb-6 text-sm text-yellow-700 bg-yellow-100 border border-yellow-400 rounded-lg dark:bg-yellow-900 dark:text-yellow-200 dark:border-yellow-700">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('evaluate.submit') }}">
            @csrf

            {{-- Email input --}}
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Your email address
                </label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Star rating --}}
            <div class="mb-8" x-data="starRating()">
                <label class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">
                    How would you rate the overall experience of the event?
                </label>

                <input type="hidden" name="rating" x-model="rating">

                <div class="flex gap-x-2 mb-2">
                    <template x-for="i in 5">
                        <span 
                            @click="set(i)" 
                            @mouseover="hover(i)" 
                            @mouseleave="reset()" 
                            class="text-5xl cursor-pointer transition-all"
                            :class="display >= i ? 'text-yellow-400' : 'text-gray-300'">
                            ★
                        </span>
                    </template>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    <template x-if="rating == 0">
                        <span>Please select a rating</span>
                    </template>
                    <template x-if="rating == 1"><span>Poor</span></template>
                    <template x-if="rating == 2"><span>Fair</span></template>
                    <template x-if="rating == 3"><span>Good</span></template>
                    <template x-if="rating == 4"><span>Very Good</span></template>
                    <template x-if="rating == 5"><span>Excellent</span></template>
                </p>

                <x-input-error :messages="$errors->get('rating')" class="mt-2" />
            </div>

            <script>
                function starRating() {
                    return {
                        rating: {{ old('rating', 0) }},
                        temp: 0,
                        get display() { return this.temp ? this.temp : this.rating; },
                        set(i) { this.rating = i; },
                        hover(i) { this.temp = i; },
                        reset() { this.temp = 0; }
                    }
                }
            </script>

            {{-- Comments --}}
            <div class="mb-6">
                <label for="comments" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Any comments or suggestions about the event?
                </label>
                <textarea id="comments" name="comments" rows="6"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Please share your feedback here...">{{ old('comments') }}</textarea>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maximum 1000 characters</p>
                <x-input-error :messages="$errors->get('comments')" class="mt-2" />
            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-x-4 mt-8">
                <a href="/" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    Cancel
                </a>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Submit Evaluation
                </button>
            </div>
        </form>
    </div>
@endsection

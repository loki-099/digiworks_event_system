@extends('layouts.guest')

@section('name', 'Register')

@section('content')
    <div x-data="{ next: false }">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div x-data="{ type: '{{ old('type') }}' }">
                <div x-show="! next" x-transition>
                    <!-- Name -->
                    <div class="mb-6 w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Full name
                        </label>
                        <input type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="name" value="{{ old('name') }}" autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email -->
                    <div class="mb-6 w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="text" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="email" value="{{ old('email') }}" autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- TYPE -->
                    <fieldset class="flex gap-x-8 mb-6">
                        <legend class="sr-only">Type</legend>
                        <div class="flex items-center">
                            <input id="student" type="radio" name="type" value="student" x-model="type"
                                {{ old('type') === 'student' ? 'checked' : '' }}
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="student" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Student
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="professional" type="radio" name="type" value="professional" x-model="type"
                                {{ old('type') === 'professional' ? 'checked' : '' }}
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="professional"
                                class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Professional
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="other" type="radio" name="type" value="other" x-model="type"
                                {{ old('type') === 'other' ? 'checked' : '' }}
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="other" class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Other
                            </label>
                        </div>
                    </fieldset>
                    {{-- <hr class="h-px my-4 bg-neutral-quaternary border-0"> --}}
                    <!-- AFFILIATION + POSITION (Hidden until selected) -->
                    <div x-show="type" x-transition>
                        <!-- AFFILIATION -->
                        <div class="mb-6 mt-6 w-full">
                            <label for="affiliation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <span x-show="type === 'student'">University Name</span>
                                <span x-show="type === 'professional'">Company/Organization</span>
                                <span x-show="type === 'other'">Affiliation</span>
                            </label>
                            <input type="text" id="affiliation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="affiliation" value="{{ old('affiliation') }}" autocomplete="organization">
                            <x-input-error :messages="$errors->get('affiliation')" class="mt-2" />
                        </div>
                        <!-- POSITION -->
                        <div class="mb-6 w-full">
                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <span x-show="type === 'student'">Program</span>
                                <span x-show="type === 'professional'">Position</span>
                                <span x-show="type === 'other'">Please Specify</span>
                            </label>
                            <input type="text" id="position"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="position" value="{{ old('position') }}" autocomplete="off">
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>
                    </div>
                </div>
                {{-- EVENT AND WORKSHOP --}}
                <div x-show="next" x-transition class="mb-6">
                    <h2 class="text-gray-950 dark:text-white text-xl font-bold mb-4">Event</h2>
                    <hr class="h-px bg-neutral-quaternary border-0 mb-6">
                    <div class="flex gap-x-8 mb-6">
                        <div class="flex items-center gap-x-4">
                            <input type="hidden" name="is_going" value="0">
                            <input id="is_going" type="checkbox" name="is_going" value="1"
                                {{ old('is_going', 1) ? 'checked' : '' }}
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_going"
                                class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">
                                <div
                                    class="flex items-center justify-center relative max-w-full max-h-40 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left overflow-hidden cursor-pointe">
                                    <img src="{{ asset('/images/event.png') }}" alt="">
                                    <div class="bg-linear-to-t from-gray-950 absolute top-0 bottom-0 right-0 left-0"></div>
                                    <div class="absolute left-3 bottom-3">
                                        <p class="text-white text-2xl font-bold">{{ $event->name }}</p>
                                        <p class="text-white text-sm font-medium">From:
                                            {{ date('F d, Y g:iA', strtotime($event->start_date)) }}
                                        </p>
                                        <p class="text-white text-sm font-medium">To:
                                            {{ date('F d, Y g:iA', strtotime($event->end_date)) }}

                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <h2 class="text-gray-950 dark:text-white text-xl font-bold mb-4">Workshops</h2>
                    <hr class="h-px bg-neutral-quaternary border-0 mb-6">
                    <div class="flex flex-col gap-y-4">
                        @forelse ($workshops as $workshop)
                            <div class="flex items-center gap-x-4">
                                <input id="workshop-{{ $workshop->id }}" type="radio" name="workshop"
                                    value="{{ $workshop->id }}"
                                    class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                <label for="workshop-{{ $workshop->id }}"
                                    class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 w-full">
                                    <div
                                        class="flex items-center justify-center relative max-w-full max-h-40 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left overflow-hidden cursor-pointer">
                                        <img src="{{ asset('/images/subtle-prism.svg') }}" alt=""
                                            class="w-full">
                                        <div class="bg-linear-to-t from-gray-950 absolute top-0 bottom-0 right-0 left-0">
                                        </div>
                                        <div class="absolute left-3 bottom-3">
                                            <p class="text-white text-2xl font-bold leading-6 mb-1">{{ $workshop->name }}
                                            </p>
                                            <p class="text-white text-sm font-medium">From:
                                                {{ date('F d, Y g:iA', strtotime($workshop->start_date)) }}
                                            </p>
                                            <p class="text-white text-sm font-medium">To:
                                                {{ date('F d, Y g:iA', strtotime($workshop->end_date)) }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <button type="button"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        x-on:click="next = ! next" x-show="next">Back</button>

                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        x-on:click="next = ! next" x-show="! next">Next</button>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        x-show="next">Submit</button>

                </div>
            </div>
        </form>
    </div>

@endsection

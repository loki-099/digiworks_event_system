@extends('layouts.guest')

@section('name', 'Register')

@section('content')
    <div x-data="{ next: false }">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div x-data="{ type: '{{ old('type', 'student') }}' }">
                <div x-show="! next" x-transition>
                    <!-- Name -->
                    <div class="mb-6 w-full">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Full name
                        </label>
                        <input type="text" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="name" value="{{ old('name') }}" autocomplete="name" placeholder="Juan Dela Cruz">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <!-- Email -->
                    <div class="mb-6 w-full">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email
                        </label>
                        <input type="text" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="email" value="{{ old('email') }}" autocomplete="username" placeholder="juan@email.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- TYPE -->
                    <fieldset class="flex gap-x-8 mb-6">
                        <legend class="sr-only">Type</legend>
                        <div class="flex items-center">
                            <input id="student" type="radio" name="type" value="student" x-model='type'
                                :checked="type === 'student' || (type === null && 'student')"
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
                                <span x-show="type === 'student'">University/School Name</span>
                                <span x-show="type === 'professional'">Company/Organization</span>
                                <span x-show="type === 'other'">Affiliation</span>
                            </label>
                            <input type="text" id="affiliation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="affiliation" value="{{ old('affiliation') }}" autocomplete="organization"
                                x-bind:placeholder="type === 'student' ? 'University of Southern Mindanao' :
                                    type === 'professional' ? 'Enter your company or organization' :
                                    'Enter your affiliation'">
                            <x-input-error :messages="$errors->get('affiliation')" class="mt-2" />
                        </div>
                        <!-- POSITION -->
                        <div class="mb-6 w-full">
                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                <span x-show="type === 'student'">Program/Course</span>
                                <span x-show="type === 'professional'">Position</span>
                                <span x-show="type === 'other'">Please Specify</span>
                            </label>
                            <input type="text" id="position"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="position" value="{{ old('position') }}" autocomplete="off"
                                x-bind:placeholder="type === 'student' ? 'Bachelor of Science in Computer Science' :
                                    type === 'professional' ? 'Enter your job position' :
                                    'Please specify'">
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
                    <h2 class="text-gray-950 dark:text-white text-xl font-bold mb-4">Pitching Event and Exhibition</h2>
                    <hr class="h-px bg-neutral-quaternary border-0 mb-6">
                    {{-- PITCHING EVENT --}}
                    <div class="w-full p-2" x-data="{ participating: '{{ old('pitching', 'not-participating') }}' }">
                        <label for="not-participating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pitching Event</label>
                        <div class="flex items-center gap-x-4 mb-2">
                            <ul
                                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="not-participating" type="radio" value="not-participating"
                                            name="pitching"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model='participating'>
                                        <label for="not-participating"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Not
                                            Participating</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="participating" type="radio" value="participating" name="pitching"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model='participating'>
                                        <label for="participating"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Participating</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        {{-- PARTICIPATING FORM --}}
                        <div x-show=" participating === 'participating' " x-transition>
                            <div class="mt-6 mb-6 w-full">
                                <label for="group_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Group Name
                                </label>
                                <input type="text" id="group_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="group_name" value="{{ old('group_name') }}" autocomplete="group_name"
                                    placeholder="Strategic Solutions">
                                <x-input-error :messages="$errors->get('group_name')" class="mt-2" />
                            </div>
                            <div class="mb-6 w-full">
                                <label for="pitching_organization"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Organization/School
                                </label>
                                <input type="text" id="pitching_organization"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="pitching_organization" value="{{ old('pitching_organization') }}"
                                    autocomplete="pitching_organization" placeholder="University of Southern Mindanao">
                                <x-input-error :messages="$errors->get('pitching_organization')" class="mt-2" />
                            </div>
                            <div class="mb-6 w-full">
                                <label for="team_members"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Team Members
                                </label>
                                <input type="text" id="team_members"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="team_members" value="{{ old('team_members') }}" autocomplete="team_members"
                                    placeholder="Full names (separate by comma)">
                                <x-input-error :messages="$errors->get('team_members')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- PRODUCT EXHIBITION --}}
                    <div class="w-full p-2" x-data="{ exhibit_product: '{{ old('product', '0') }}' }">
                        <label for="product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Exhibition</label>
                        <div class="flex items-center gap-x-4 mb-6">
                            <ul
                                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="no-product" type="radio" value="0"
                                            name="product"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model='exhibit_product'>
                                        <label for="no-product"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Not
                                            Participating</label>
                                    </div>
                                </li>
                                <li class="w-full dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="product" type="radio" value="1" name="product"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            x-model='exhibit_product'>
                                        <label for="product"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Participating</label>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        {{-- PARTICIPATING FORM --}}
                        <div x-show=" exhibit_product === '1' " x-transition>
                            <div class="mb-6 w-full">
                                <label for="exhibit_product"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Product Name
                                </label>
                                <input type="text" id="exhibit_product"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="exhibit_product" value="{{ old('exhibit_product') }}" autocomplete="exhibit_product"
                                    placeholder="Strategic Solutions">
                                <x-input-error :messages="$errors->get('exhibit_product')" class="mt-2" />
                            </div>
                            <div class="mb-6 w-full">
                                <label for="phone_number"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Phone Number (PH)
                                </label>
                                <input type="tel" id="phone_number"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    name="phone_number" value="{{ old('phone_number') }}" autocomplete="tel-national"
                                    placeholder="09XXXXXXXXX">
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    {{-- WORKSHOPS --}}
                    {{-- <h2 class="text-gray-950 dark:text-white text-xl font-bold mb-4">Workshops</h2>
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
                    </div> --> --}}

                </div>
                <div class="flex items-center" x-show="! next">
                    <input id="link-checkbox" type="checkbox" value=""
                        class="w-4 h-4 mr-2 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="text-gray-900 dark:text-white/80 text-sm">I am aware that my
                        personal information will be used for certification purposes.</label>
                </div>
                <div class="flex items-start justify-between mt-4 gap-x-8 w-full">
                    <button type="button"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        x-on:click="next = ! next" x-show="next">Back</button>

                    <button type="button"
                        class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        x-on:click="next = ! next" x-show="! next">Proceed</button>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ml-auto dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        x-show="next">Submit</button>

                </div>
            </div>
        </form>
    </div>

@endsection

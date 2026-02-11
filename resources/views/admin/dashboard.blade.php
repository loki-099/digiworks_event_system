@extends('layouts.admin')

@section('title', 'Dashboard')


@section('content')
    {{-- <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="/admin/dashboard" class="flex ms-2 md:me-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Admin
                            Dashboard</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/images/people/profile-picture-5.jpg" alt="user photo">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" role="none">
                                <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    {{ $admin->name }}
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    {{ $admin->email }}
                                </p>
                            </div>
                            <ul class="py-1" role="none">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Settings</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Earnings</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> --}}
    {{-- 
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
            Dashboard Link
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::routeIs('admin.dashboard') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 transition duration-75 {{ Request::routeIs('admin.dashboard') ? 'text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400' }} group-hover:text-gray-900 dark:group-hover:text-white" 
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                        <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            User Page link
            <li>
                <a href="{{ route('admin.users') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Request::routeIs('admin.users') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                    <svg class="shrink-0 w-5 h-5 transition duration-75 {{ Request::routeIs('admin.users') ? 'text-gray-900 dark:text-white' : 'text-gray-500 dark:text-gray-400' }} group-hover:text-gray-900 dark:group-hover:text-white" 
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                </a>
            </li>
        </ul>
        </div>
    </aside>
  --}}

    {{-- MAIN CONTENT --}}
    <div class="p-4 sm:ml-64 min-h-screen dark:bg-gray-950">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            @isset($event)
                <div
                    class="flex items-center justify-center h-64 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800 overflow-hidden relative">
                    <img src="{{ asset('images/event.png') }}" alt="DigiWork" class="w-full">
                    <div class="bg-linear-to-t from-gray-950 absolute top-0 bottom-0 right-0 left-0"></div>
                    <div class="absolute left-3 bottom-3">
                        <p class="text-white text-2xl font-bold">{{ $event->name }}</p>
                        <p class="text-white text-sm font-medium">From: {{ date('F d, Y g:iA', strtotime($event->start_date)) }}
                        </p>
                        <p class="text-white text-sm font-medium">To: {{ date('F d, Y g:iA', strtotime($event->end_date)) }}</p>
                    </div>
                    <button type="button" data-modal-target="edit-event-modal" data-modal-toggle="edit-event-modal"
                        class="bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amber-600 dark:hover:bg-amber-700 focus:outline-none dark:focus:ring-amber-800 absolute top-2 right-2"><svg
                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                    {{-- ATTENDING CARD --}}
                    <div
                        class="flex items-center justify-start gap-x-4 dark:text-white px-4 h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                        <div>
                            <span
                                class="w-16 h-16 p-1 bg-white dark:bg-gray-800 border border-gray-600 rounded-sm flex items-center justify-center">
                                <svg class="w-full h-full text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-950 dark:text-white">{{ $attendees }}</p>
                            <h2 class="text-sm">Total Registered</h2>
                        </div>
                    </div>

                    {{-- CARD 2 --}}
                    <div
                        class="flex items-center justify-start gap-x-4 dark:text-white px-4 h-24 rounded-sm bg-gray-50 dark:bg-gray-800">
                        <div>
                            <span
                                class="w-16 h-16 p-1 bg-white dark:bg-gray-800 border border-gray-600 rounded-sm flex items-center justify-center">
                                <svg class="w-full h-full text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </span>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-gray-950 dark:text-white">0</p>
                            <h2 class="text-sm">Total Checked-in</h2>
                        </div>
                    </div>

                    {{-- CARD 3 --}}
                    <a href="{{ route('attendance.event')}}" class="group flex items-center justify-start gap-x-4 text-white px-4 h-24 rounded-sm bg-brand box-border border border-transparent hover:bg-brand-strong cursor-pointer">
                        <div>
                            <span
                                class="w-16 h-16 p-1 bg-brand group-hover:bg-brand-strong box-border border border-transparent rounded-sm flex items-center justify-center">
                                <svg class="w-full h-full text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4h6v6H4V4Zm10 10h6v6h-6v-6Zm0-10h6v6h-6V4Zm-4 10h.01v.01H10V14Zm0 4h.01v.01H10V18Zm-3 2h.01v.01H7V20Zm0-4h.01v.01H7V16Zm-3 2h.01v.01H4V18Zm0-4h.01v.01H4V14Z" />
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01v.01H7V7Zm10 10h.01v.01H17V17Z" />
                                </svg>

                            </span>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-white">Scan QR Code</p>
                            <h2 class="text-sm">Check-in</h2>
                        </div>
                    </a>
                </div>
                <div class="mt-10 flex items-center justify-between">
                    <h1 class="text-3xl text-gray-950 dark:text-white font-bold">Workshops</h1>
                    <button type="button" data-modal-target="add-workshop-modal" data-modal-toggle="add-workshop-modal"
                        class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Add
                        Workshop</button>
                </div>
                <hr class="h-px my-2 bg-neutral-quaternary border-0">
                {{-- WORKSHOPS GRID --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 my-4">
                    @forelse ($workshops as $workshop)
                        <button type="button" data-modal-target="edit-workshop-modal-{{ $workshop->id }}"
                            data-modal-toggle="edit-workshop-modal-{{ $workshop->id }}"
                            class="block relative max-w-full h-80 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left justify-end overflow-hidden cursor-pointer">
                            <img src="{{ asset('images/protruding-squares.svg') }}" alt="placeholder"
                                class="min-h-full min-w-full mb-4">
                            <div class="bg-linear-to-t from-gray-950 absolute top-0 bottom-0 right-0 left-0"></div>
                            <div class="absolute left-3 bottom-3">
                                <p class="text-white text-2xl font-bold">{{ $workshop->name }}</p>
                                <p class="text-white text-sm font-medium">From:
                                    {{ date('F d, Y g:iA', strtotime($workshop->start_date)) }}
                                </p>
                                <p class="text-white text-sm font-medium">To:
                                    {{ date('F d, Y g:iA', strtotime($workshop->end_date)) }}</p>
                            </div>
                        </button>
                    @empty
                        <button
                            class="block relative max-w-full h-80 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-left justify-end overflow-hidden cursor-pointer"
                            data-modal-target="add-workshop-modal" data-modal-toggle="add-workshop-modal">
                            <div class="z-10">
                                <p class="text-gray-400 text-2xl font-bold text-center">No Workshop</p>
                                <p class="text-gray-400 text-sm font-bold text-center">Add a Workshop</p>
                            </div>
                        </button>
                    @endforelse
                </div>
            @else
                <div class="flex items-center justify-center h-32 rounded-sm bg-gray-50 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <button type="button" data-modal-target="add-event-modal" data-modal-toggle="add-event-modal"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Add Event
                        </button>
                    </p>
                </div>
            @endisset

            <!-- Add Event Modal -->
            <div id="add-event-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto mx-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Add Event
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="add-event-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <form class="space-y-4" action="{{ route('addEvent') }}" method="POST">
                                @csrf
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                    <input type="text" name="name" id="title" placeholder="Event name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                </div>

                                <div>
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                                    <textarea id="description" name="description" rows="4" placeholder="Short description"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                </div>

                                <div>
                                    <label for="venue"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Venue</label>
                                    <input type="text" name="venue" id="venue" placeholder="Venue or location"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="start_date"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start
                                            Date</label>
                                        <input type="datetime-local" name="start_date" id="start_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>
                                    <div>
                                        <label for="end_date"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">End
                                            Date</label>
                                        <input type="datetime-local" name="end_date" id="end_date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="flex items-center justify-end space-x-2 pt-4 border-t dark:border-gray-600">
                                    <button data-modal-hide="add-event-modal" type="button"
                                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg border border-gray-200 text-sm px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Event Modal -->
            @isset($event)
                <div id="edit-event-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto mx-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Edit Event
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="edit-event-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <form class="space-y-4" action="{{ route('updateEvent', $event->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="edit_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" id="edit_name" placeholder="Event name"
                                            value="{{ $event->name }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>

                                    <div>
                                        <label for="edit_description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                                        <textarea id="edit_description" name="description" rows="4" placeholder="Short description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{ $event->description }}</textarea>
                                    </div>

                                    <div>
                                        <label for="edit_venue"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Venue</label>
                                        <input type="text" name="venue" id="edit_venue" placeholder="Venue or location"
                                            value="{{ $event->venue }}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="edit_start_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start
                                                Date</label>
                                            <input type="datetime-local" name="start_date" id="edit_start_date"
                                                value="{{ date('Y-m-d\TH:i', strtotime($event->start_date)) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>
                                        <div>
                                            <label for="edit_end_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">End
                                                Date</label>
                                            <input type="datetime-local" name="end_date" id="edit_end_date"
                                                value="{{ date('Y-m-d\TH:i', strtotime($event->end_date)) }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-end space-x-2 pt-4 border-t dark:border-gray-600">
                                        <button data-modal-hide="edit-event-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg border border-gray-200 text-sm px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            <!-- Add Workshop Modal -->
            @isset($event)
                <div id="add-workshop-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto mx-auto">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Add Workshop
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="add-workshop-modal">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <form class="space-y-4" action="{{ route('addWorkshop', $event->id) }}" method="POST">
                                    @csrf
                                    <div>
                                        <label for="workshop_name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                        <input type="text" name="name" id="workshop_name" placeholder="Workshop name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>

                                    <div>
                                        <label for="workshop_description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                                        <textarea id="workshop_description" name="description" rows="4" placeholder="Workshop description"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                    </div>

                                    <div>
                                        <label for="workshop_speaker"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Speaker</label>
                                        <input type="text" name="speaker" id="workshop_speaker"
                                            placeholder="Speaker name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>

                                    <div>
                                        <label for="workshop_venue"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Venue</label>
                                        <input type="text" name="venue" id="workshop_venue"
                                            placeholder="Venue or location"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>

                                    <div>
                                        <label for="capacity"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Capacity</label>
                                        <input type="number" name="capacity" id="capacity"
                                            placeholder="Maximum participants"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="workshop_start_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start
                                                Date</label>
                                            <input type="datetime-local" name="start_date" id="workshop_start_date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>
                                        <div>
                                            <label for="workshop_end_date"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">End
                                                Date</label>
                                            <input type="datetime-local" name="end_date" id="workshop_end_date"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-end space-x-2 pt-4 border-t dark:border-gray-600">
                                        <button data-modal-hide="add-workshop-modal" type="button"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg border border-gray-200 text-sm px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                                        <button type="submit"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Workshop Modals -->
                @forelse($workshops as $workshop)
                    <div id="edit-workshop-modal-{{ $workshop->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto mx-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Edit Workshop
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="edit-workshop-modal-{{ $workshop->id }}">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-6">
                                    <form id="update-workshop-form-{{ $workshop->id }}" class="space-y-4"
                                        action="{{ route('updateWorkshop', $workshop->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <label for="edit_workshop_name_{{ $workshop->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                                            <input type="text" name="name" id="edit_workshop_name_{{ $workshop->id }}"
                                                placeholder="Workshop name" value="{{ $workshop->name }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>

                                        <div>
                                            <label for="edit_workshop_description_{{ $workshop->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                                            <textarea id="edit_workshop_description_{{ $workshop->id }}" name="description" rows="4"
                                                placeholder="Workshop description"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{ $workshop->description }}</textarea>
                                        </div>

                                        <div>
                                            <label for="edit_workshop_speaker_{{ $workshop->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Speaker</label>
                                            <input type="text" name="speaker"
                                                id="edit_workshop_speaker_{{ $workshop->id }}" placeholder="Speaker name"
                                                value="{{ $workshop->speaker }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>

                                        <div>
                                            <label for="edit_workshop_venue_{{ $workshop->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Venue</label>
                                            <input type="text" name="venue"
                                                id="edit_workshop_venue_{{ $workshop->id }}" placeholder="Venue or location"
                                                value="{{ $workshop->venue }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>

                                        <div>
                                            <label for="edit_workshop_capacity_{{ $workshop->id }}"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Capacity</label>
                                            <input type="number" name="capacity"
                                                id="edit_workshop_capacity_{{ $workshop->id }}"
                                                placeholder="Maximum participants" value="{{ $workshop->capacity }}"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="edit_workshop_start_date_{{ $workshop->id }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start
                                                    Date</label>
                                                <input type="datetime-local" name="start_date"
                                                    id="edit_workshop_start_date_{{ $workshop->id }}"
                                                    value="{{ date('Y-m-d\TH:i', strtotime($workshop->start_date)) }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                            </div>
                                            <div>
                                                <label for="edit_workshop_end_date_{{ $workshop->id }}"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">End
                                                    Date</label>
                                                <input type="datetime-local" name="end_date"
                                                    id="edit_workshop_end_date_{{ $workshop->id }}"
                                                    value="{{ date('Y-m-d\TH:i', strtotime($workshop->end_date)) }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                                            </div>
                                        </div>

                                        <!-- end form inputs -->
                                    </form>

                                    <!-- Modal footer -->
                                    <div class="flex items-center justify-between pt-4 border-t dark:border-gray-600">
                                        <div class="flex items-center space-x-2">
                                            <button data-modal-hide="edit-workshop-modal-{{ $workshop->id }}" type="button"
                                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg border border-gray-200 text-sm px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                                            <button form="update-workshop-form-{{ $workshop->id }}" type="submit"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <form action="{{ route('deleteWorkshop', $workshop->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this workshop?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-red-500 dark:hover:bg-red-600 focus:outline-none">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            @endisset

            {{-- QR CODE SCANNER MODAL --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const html5QrCode = new Html5Qrcode("reader");
        let isScanning = false;

        function startScanner() {
            if (isScanning) return;

            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText) => {
                    console.log("Scanned:", decodedText);

                    // Optional: auto-stop after successful scan
                    stopScanner();

                    // Redirect
                    window.location.href = route + decodedText;
                }
            ).then(() => {
                isScanning = true;
            }).catch(err => {
                console.error("Camera start error:", err);
            });
        }

        function stopScanner() {
            if (!isScanning) return;

            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                isScanning = false;
            }).catch(err => {
                console.error("Camera stop error:", err);
            });
        }
    </script>
@endsection

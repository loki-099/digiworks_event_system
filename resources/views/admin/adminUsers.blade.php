@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
    {{-- <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    Mobile toggle button
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                        type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    Logo: Redirects back to Dashboard
                    <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Admin Dashboard</span>
                    </a>
                </div>
                User Profile Dropdown
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/images/people/profile-picture-5.jpg" alt="user photo">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav> --}}

    {{-- Sidebar: Left fixed navigation --}}
    {{-- <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                Dashboard Link: Used to go back
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                Users Link: Current active page
                <li>
                    <a href="{{ route('admin.users') }}"
                        class="flex items-center p-2 text-gray-900 bg-gray-100 rounded-lg dark:text-white dark:bg-gray-700 group">
                        <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside> --}}
    
    {{-- Main Content Area --}}
    <div class="p-4 sm:ml-64 min-h-screen dark:bg-gray-950">
        <div class="p-4 mt-14">
            {{-- Page Header --}}
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Event Attendees</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $registrations->count() }}</p>
            </div>

            {{-- Search Bar --}}
            <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                <form action="{{ route('admin.users') }}" method="GET" class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Search for attendees...">
                </form>
                @if(request('search'))
                    <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:underline">Clear Search</a>
                @endif
            </div>

            {{-- Excel-Style Table: Re-arranged Flow --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3 border-r dark:border-gray-600 text-center">Reg ID</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Reg. Date</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Attendee Name</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Email</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Affiliation</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Workshop</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">QR Value</th>
                            <th class="px-6 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $registration)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            {{-- 1. Reg ID --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700 font-mono text-xs text-center">#{{ $registration->id }}</td>
                            
                            {{-- 2. Reg Date --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700">
                                {{ \Carbon\Carbon::parse($registration->registered_date)->format('d M Y') }}
                            </td>

                            {{-- 3. Attendee Name --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                {{ $registration->attendee->name ?? 'N/A' }}
                            </td>

                            {{-- 4. Email --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700">
                                {{ $registration->attendee->email ?? 'N/A' }}
                            </td>

                            {{-- 5. Affiliation --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700 italic">
                                {{ $registration->attendee->affiliation ?? '—' }}
                            </td>

                            {{-- 6. Workshop --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700">
                                {{ $registration->workshop->name ?? 'General Admission' }}
                            </td>

                            {{-- 7. QR Value --}}
                            <td class="px-6 py-4 border-r dark:border-gray-700 font-mono text-xs">
                                {{ $registration->qr_code_value ?? 'Pending' }}
                            </td>

                            {{-- 8. Status --}}
                            <td class="px-6 py-4 text-center">
                                <span class="px-2 py-1 rounded text-xs font-bold {{ $registration->status === 'registered' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ strtoupper($registration->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
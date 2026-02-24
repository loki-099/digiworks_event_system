@extends('layouts.admin')

@section('title', 'Attendance Log')

@section('content')
    <div class="p-4 sm:ml-64 min-h-screen dark:bg-gray-950">
        <div class="p-4 mt-14">
            {{-- Success/Error Messages --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 dark:bg-green-900 dark:text-green-200 rounded">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 dark:bg-red-900 dark:text-red-200 rounded">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Attendance Log History</h1>
                <a href="{{ route('attendance.export') }}"
                    class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-4 py-2">
                    Export to Excel
                </a>
            </div>

            {{-- <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
                <form action="{{ route('admin.users') }}" method="GET" class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Search for attendees...">
                </form>
                <a href="{{ route('admin.users.export') }}"
                    class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm px-4 py-2">
                    Export to Excel
                </a>
                @if (request('search'))
                    <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:underline">Clear Search</a>
                @endif
            </div> --}}

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3 border-r dark:border-gray-600">For</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Time In</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Attendee Name</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">AFfiliation</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Pitching Group Name</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Pitching Organization</th>
                            <th class="px-6 py-3 border-r dark:border-gray-600">Product Exhibition</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                {{-- For --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ $attendance->for == 'event' ? 'EVENT' : 'PITCHING' }}
                                </td>
                                {{-- Time In --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ date('F d, Y g:iA', strtotime($attendance->created_at)) }}
                                </td>
                                {{-- Attendee Name --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ $attendance->registration->attendee->name }}
                                </td>
                                {{-- Affiliation --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ $attendance->registration->attendee->affiliation }}
                                </td>
                                {{-- Pitching Group Name --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ $attendance->registration->pitching->group_name ?? 'Not Participating' }}
                                </td>
                                {{-- Pitching Organization --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ $attendance->registration->pitching->organization ?? 'Not Participating' }}
                                </td>
                                {{-- Product Exhibition --}}
                                <td
                                    class="px-6 py-4 border-r dark:border-gray-700 font-medium text-gray-900 dark:text-white">
                                    {{ $attendance->registration->exhibit_product ?? 'Not Participating' }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('attendance.log.delete', ['id' => $attendance->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this log?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-white bg-red-600 hover:bg-red-700 font-medium rounded-lg text-xs px-3 py-1.5 transition-colors">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4 px-2">
                {{ $attendances->appends(request()->query())->links() }}
            </div>

        </div>

    </div>

@endsection

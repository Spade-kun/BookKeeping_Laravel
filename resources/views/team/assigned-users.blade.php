@extends('layouts.dashboard')

@section('title', 'Assigned Users')
@section('page-title', 'Assigned Users')

@section('sidebar')
    @include('partials.team-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Assigned Users</h1>
            @if($team)
                <p class="text-[#4A5568] mt-1">Users assigned to {{ $team->name }}</p>
            @else
                <p class="text-[#4A5568] mt-1">You are not assigned to a team</p>
            @endif
        </div>
    </div>

    @if($team && $users->isNotEmpty())
        <!-- Stats Card -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Total Assigned Users</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $users->total() }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Users List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#E6F2FF]">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">User</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Thread Status</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Documents</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Reports</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-[#E6F2FF] flex items-center justify-center">
                                            <span class="text-[#0066CC] font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @if($user->thread)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                            @if($user->thread->status === 'open') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($user->thread->status) }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-500">No thread</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $user->documents->count() }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $user->reports->count() }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->thread)
                                        <a href="{{ route('threads.show', $user->thread) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] font-medium text-sm">
                                            View Thread
                                        </a>
                                    @else
                                        <span class="text-sm text-gray-400">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-md p-12">
            <div class="text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                @if($team)
                    <p class="text-gray-500">No users assigned to your team yet</p>
                @else
                    <p class="text-gray-500">You need to be assigned to a team first</p>
                    <p class="text-sm text-gray-400 mt-2">Contact your administrator to join a team</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

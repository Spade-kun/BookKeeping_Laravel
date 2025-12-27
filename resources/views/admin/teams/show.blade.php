@extends('layouts.dashboard')

@section('title', 'Team Details - ' . $team->name)
@section('page-title', 'Team Details')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.teams.index') }}" class="text-[#0066CC] hover:text-[#003366] transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-[#003366]">{{ $team->name }}</h1>
            </div>
            @if($team->description)
                <p class="text-[#4A5568] mt-1 ml-9">{{ $team->description }}</p>
            @endif
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.teams.edit', $team) }}" class="bg-[#0066CC] text-white px-6 py-3 rounded-lg hover:bg-[#003366] transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <p class="text-white">Edit Team</p>
            </a>
            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Team
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Team Members</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $team->users->count() }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Team Leads</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $team->users->where('pivot.role', 'lead')->count() }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Assigned Threads</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $team->threads->count() }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Members Section -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-[#003366] mb-4">Team Members</h2>
        
        @if($team->users->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p class="text-gray-500">No team members yet</p>
                <a href="{{ route('admin.teams.edit', $team) }}" class="text-[#0066CC] hover:text-[#003366] mt-2 inline-block">
                    Add members to this team
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#E6F2FF]">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Role in Team</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">User Role</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($team->users as $user)
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
                                    @if($user->pivot->role === 'lead')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#0066CC] text-white">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                            </svg>
                                            Team Lead
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#003366]">
                                            Member
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        @if($user->role === 'admin') bg-purple-100 text-purple-800
                                        @elseif($user->role === 'team') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Assigned Threads Section -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold text-[#003366] mb-4">Assigned Support Threads</h2>
        
        @if($team->threads->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <p class="text-gray-500">No threads assigned to this team yet</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($team->threads as $thread)
                    <div class="border border-gray-200 rounded-lg p-4 hover:border-[#0066CC] transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <h3 class="text-lg font-semibold text-[#003366]">
                                        Thread #{{ $thread->id }}
                                    </h3>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                        @if($thread->status === 'open') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst($thread->status) }}
                                    </span>
                                </div>
                                <div class="mt-2 flex items-center space-x-4 text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        {{ $thread->user->name }}
                                    </div>
                                    @if($thread->last_message_at)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Last message: {{ $thread->last_message_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ route('threads.show', $thread) }}" class="ml-4 bg-[#0066CC] text-white px-4 py-2 rounded-lg hover:bg-[#003366] transition-colors text-sm">
                                View Thread
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

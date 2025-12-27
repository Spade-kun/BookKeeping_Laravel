@extends('layouts.dashboard')

@section('title', 'Team Management')
@section('page-title', 'Team Management')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Team Management</h1>
            <p class="text-[#4A5568] mt-1">Organize staff into teams and manage assignments</p>
        </div>
        <a href="{{ route('admin.teams.create') }}" class="bg-[#0066CC] text-white px-6 py-3 rounded-lg hover:bg-[#003366] transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
           <p class="text-white"> Create Team</p>
        </a>
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
                    <p class="text-sm text-[#4A5568]">Total Teams</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $teams->total() }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Total Members</p>
                    <p class="text-3xl font-bold text-[#0066CC] mt-1">{{ $teams->sum('users_count') }}</p>
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
                    <p class="text-sm text-[#4A5568]">Active Threads</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ \App\Models\Thread::where('status', 'open')->count() }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Teams Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($teams as $team)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-[#003366]">{{ $team->name }}</h3>
                            @if($team->description)
                                <p class="text-sm text-[#4A5568] mt-1">{{ Str::limit($team->description, 60) }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Team Stats -->
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center text-sm text-[#4A5568]">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            {{ $team->users_count }} {{ Str::plural('member', $team->users_count) }}
                        </div>
                    </div>

                    <!-- Team Members Preview -->
                    @if($team->users->count() > 0)
                        <div class="mb-4">
                            <p class="text-xs text-[#4A5568] mb-2">Team Members:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach($team->users->take(3) as $member)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#0066CC]">
                                        {{ $member->name }}
                                        @if($member->pivot->role === 'lead')
                                            <svg class="w-3 h-3 ml-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endif
                                    </span>
                                @endforeach
                                @if($team->users->count() > 3)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        +{{ $team->users->count() - 3 }} more
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex items-center space-x-2 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.teams.show', $team) }}" class="flex-1 text-center bg-[#E6F2FF] text-[#0066CC] px-4 py-2 rounded-lg hover:bg-[#0066CC] hover:text-white transition-colors text-sm font-medium">
                            View Details
                        </a>
                        <a href="{{ route('admin.teams.edit', $team) }}" class="flex-1 text-center bg-[#F7FAFC] text-[#4A5568] px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="text-gray-500 text-lg">No teams created yet</p>
                <a href="{{ route('admin.teams.create') }}" class="inline-block mt-4 bg-[#0066CC] text-white px-6 py-2 rounded-lg hover:bg-[#003366] transition-colors">
                    Create Your First Team
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($teams->hasPages())
        <div class="bg-white rounded-xl shadow-md p-6">
            {{ $teams->links() }}
        </div>
    @endif
</div>
@endsection

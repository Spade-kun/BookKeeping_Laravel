@extends('layouts.dashboard')

@section('title', 'Team Dashboard')
@section('page-title', 'Team Dashboard')

@section('sidebar')
    @include('partials.team-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Team Dashboard</h1>
            @if($team)
                <p class="text-[#4A5568] mt-1">{{ $team->name }} - {{ $team->users->count() }} {{ Str::plural('member', $team->users->count()) }}</p>
            @else
                <p class="text-[#4A5568] mt-1">You are not assigned to a team yet</p>
            @endif
        </div>
    </div>

    @if(!$team)
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
            <p class="text-yellow-700">You have not been assigned to a team yet. Please contact your administrator.</p>
        </div>
    @else
        <!-- Stats Cards -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#4A5568]">Open Threads</p>
                        <p class="text-3xl font-bold text-[#0066CC] mt-1">{{ $openThreads->count() }}</p>
                    </div>
                    <div class="bg-[#E6F2FF] p-3 rounded-lg">
                        <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#4A5568]">Assigned Users</p>
                        <p class="text-3xl font-bold text-[#003366] mt-1">{{ $assignedUsers->count() }}</p>
                    </div>
                    <div class="bg-[#E6F2FF] p-3 rounded-lg">
                        <svg class="w-8 h-8 text-[#003366]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-[#4A5568]">Team Members</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $team->users->count() }}</p>
                    </div>
                    <div class="bg-green-50 p-3 rounded-lg">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Threads -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-[#003366]">Recent Threads</h2>
                    <a href="{{ route('threads.index') }}" class="text-[#0066CC] hover:text-[#003366] text-sm font-medium">
                        View All →
                    </a>
                </div>
            </div>

            @if($recentThreads->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($recentThreads as $thread)
                        <a href="{{ route('threads.show', $thread) }}" class="block p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3 flex-1">
                                    @if($thread->user->avatar)
                                        <img src="{{ $thread->user->avatar }}" alt="{{ $thread->user->name }}" class="w-10 h-10 rounded-full">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-[#E6F2FF] flex items-center justify-center">
                                            <span class="text-[#0066CC] font-semibold">{{ substr($thread->user->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="font-semibold text-[#003366]">{{ $thread->user->name }}</h3>
                                            <span class="text-sm text-[#4A5568]">
                                                {{ $thread->last_message_at ? $thread->last_message_at->diffForHumans() : $thread->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        @if($thread->latestMessage)
                                            <p class="text-sm text-[#4A5568] mt-1">{{ Str::limit($thread->latestMessage->message, 80) }}</p>
                                        @else
                                            <p class="text-sm text-gray-400 mt-1 italic">No messages yet</p>
                                        @endif
                                    </div>
                                </div>
                                <span class="ml-4 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $thread->isOpen() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $thread->status }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                    <p class="text-gray-500">No message threads assigned yet</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

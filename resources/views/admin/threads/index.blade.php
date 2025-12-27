@extends('layouts.dashboard')

@section('title', 'All Message Threads')
@section('page-title', 'All Message Threads')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">All Message Threads</h1>
            <p class="text-[#4A5568] mt-1">Manage and monitor all user support conversations</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Total Threads</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $threads->total() }}</p>
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
                    <p class="text-sm text-[#4A5568]">Open Threads</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ \App\Models\Thread::where('status', 'open')->count() }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Closed Threads</p>
                    <p class="text-3xl font-bold text-gray-600 mt-1">{{ \App\Models\Thread::where('status', 'closed')->count() }}</p>
                </div>
                <div class="bg-gray-100 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Unassigned</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-1">{{ \App\Models\Thread::whereNull('team_id')->count() }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if($threads->count() > 0)
        <!-- Threads List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-[#003366]">All Conversations</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($threads as $thread)
                    <a href="{{ route('threads.show', $thread) }}" class="block p-6 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                @if($thread->user->avatar)
                                    <img src="{{ $thread->user->avatar }}" alt="{{ $thread->user->name }}" class="w-12 h-12 rounded-full">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-[#E6F2FF] flex items-center justify-center flex-shrink-0">
                                        <span class="text-[#0066CC] font-semibold text-lg">{{ substr($thread->user->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center space-x-3">
                                            <h3 class="font-semibold text-[#003366] text-lg">{{ $thread->user->name }}</h3>
                                            @if($thread->team)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#0066CC]">
                                                    {{ $thread->team->name }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Unassigned
                                                </span>
                                            @endif
                                        </div>
                                        <span class="text-sm text-[#4A5568]">
                                            {{ $thread->last_message_at ? $thread->last_message_at->diffForHumans() : $thread->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-[#4A5568] mb-2">{{ $thread->user->email }}</p>
                                    @if($thread->latestMessage)
                                        <p class="text-sm text-[#4A5568] truncate">
                                            <span class="font-medium">{{ $thread->latestMessage->sender->name }}:</span>
                                            {{ Str::limit($thread->latestMessage->message, 100) }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 italic">No messages yet</p>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-4 flex flex-col items-end space-y-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $thread->isOpen() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($thread->status) }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if($threads->hasPages())
            <div class="bg-white rounded-xl shadow-md p-6">
                {{ $threads->links() }}
            </div>
        @endif
    @else
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
            <p class="text-gray-500 text-lg">No message threads yet</p>
            <p class="text-gray-400 text-sm mt-2">Threads will appear when users start conversations</p>
        </div>
    @endif
</div>
@endsection

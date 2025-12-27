@extends('layouts.dashboard')

@section('title', 'Message Threads')
@section('page-title', 'Message Threads')

@section('sidebar')
    @include('partials.team-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Message Threads</h1>
            @if(isset($team))
                <p class="text-[#4A5568] mt-1">{{ $team->name }} - Assigned User Conversations</p>
            @else
                <p class="text-[#4A5568] mt-1">No team assigned</p>
            @endif
        </div>
    </div>

    @if($threads->count() > 0)
        <!-- Filter Tabs -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="flex border-b border-gray-200">
                <button class="flex-1 px-6 py-3 text-sm font-medium text-[#0066CC] border-b-2 border-[#0066CC]">
                    All Threads
                </button>
                <button class="flex-1 px-6 py-3 text-sm font-medium text-[#4A5568] hover:text-[#0066CC]">
                    Open Only
                </button>
                <button class="flex-1 px-6 py-3 text-sm font-medium text-[#4A5568] hover:text-[#0066CC]">
                    Closed
                </button>
            </div>
        </div>

        <!-- Threads List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
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
                                        <h3 class="font-semibold text-[#003366] text-lg">{{ $thread->user->name }}</h3>
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
                                @if($thread->messages_count ?? 0 > 0)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#0066CC]">
                                        {{ $thread->messages_count }} {{ Str::plural('message', $thread->messages_count) }}
                                    </span>
                                @endif
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
            <p class="text-gray-500 text-lg">No message threads assigned to your team yet</p>
            <p class="text-gray-400 text-sm mt-2">Threads will appear here when users are assigned to your team</p>
        </div>
    @endif
</div>
@endsection

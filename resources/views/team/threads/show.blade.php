@extends('layouts.dashboard')

@section('title', 'Thread #' . $thread->id)
@section('page-title', 'Support Thread')

@section('sidebar')
    @include('partials.team-sidebar')
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <a href="{{ route('threads.index') }}" class="text-[#0066CC] hover:text-[#003366] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#003366]">Thread #{{ $thread->id }}</h1>
                <p class="text-[#4A5568] mt-1">Conversation with {{ $thread->user->name }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            @if($thread->status === 'open')
                <form action="{{ route('threads.update-status', $thread) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="closed">
                    <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Close Thread
                    </button>
                </form>
            @else
                <form action="{{ route('threads.update-status', $thread) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="open">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Reopen Thread
                    </button>
                </form>
            @endif
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

    <!-- Thread Info Card -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-[#4A5568]">Status</p>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-1
                    @if($thread->status === 'open') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst($thread->status) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-[#4A5568]">User</p>
                <p class="text-sm font-medium text-[#003366] mt-1">{{ $thread->user->name }}</p>
                <p class="text-xs text-gray-500">{{ $thread->user->email }}</p>
            </div>
            <div>
                <p class="text-sm text-[#4A5568]">Assigned Team</p>
                @if($thread->team)
                    <p class="text-sm font-medium text-[#003366] mt-1">{{ $thread->team->name }}</p>
                @else
                    <p class="text-sm text-gray-500 mt-1">Not assigned</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Messages -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-[#003366]">Conversation</h2>
        </div>
        
        <div class="p-6 space-y-6 max-h-[600px] overflow-y-auto">
            @forelse($thread->messages as $message)
                <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-2xl {{ $message->sender_id === auth()->id() ? 'bg-[#0066CC] text-white' : 'bg-gray-100 text-gray-900' }} rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <div class="h-8 w-8 rounded-full {{ $message->sender_id === auth()->id() ? 'bg-white' : 'bg-[#E6F2FF]' }} flex items-center justify-center">
                                    <span class="{{ $message->sender_id === auth()->id() ? 'text-[#0066CC]' : 'text-[#0066CC]' }} font-semibold text-sm">
                                        {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm">{{ $message->sender->name }}</p>
                                    <p class="text-xs {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                        {{ ucfirst($message->sender_role) }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-xs {{ $message->sender_id === auth()->id() ? 'text-blue-100' : 'text-gray-500' }}">
                                {{ $message->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <p class="whitespace-pre-wrap">{{ $message->message }}</p>
                        
                        @if($message->attachment_path)
                            <div class="mt-3 pt-3 border-t {{ $message->sender_id === auth()->id() ? 'border-blue-400' : 'border-gray-300' }}">
                                <a href="{{ route('messages.download', $message) }}" 
                                   class="inline-flex items-center {{ $message->sender_id === auth()->id() ? 'text-white hover:text-blue-100' : 'text-[#0066CC] hover:text-[#003366]' }} transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download Attachment
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-gray-500">No messages yet</p>
                </div>
            @endforelse
        </div>

        <!-- Reply Form -->
        @if($thread->status === 'open')
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <form action="{{ route('messages.store', $thread) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Reply</label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="4" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0066CC] focus:ring-[#0066CC]"
                                placeholder="Type your message here..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="attachment" class="block text-sm font-medium text-gray-700 mb-2">
                                Attachment (optional, max 10MB)
                            </label>
                            <input 
                                type="file" 
                                id="attachment" 
                                name="attachment"
                                class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-lg file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-[#E6F2FF] file:text-[#0066CC]
                                    hover:file:bg-[#0066CC] hover:file:text-white
                                    file:transition-colors"
                            >
                            @error('attachment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-[#0066CC] text-white px-6 py-3 rounded-lg hover:bg-[#003366] transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="p-6 bg-gray-50 border-t border-gray-200 text-center">
                <p class="text-gray-500">This thread is closed. Reopen it to send messages.</p>
            </div>
        @endif
    </div>
</div>
@endsection

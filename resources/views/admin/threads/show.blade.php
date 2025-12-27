@extends('layouts.dashboard')

@section('title', 'Thread Details')
@section('page-title', 'Thread Details')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <a href="{{ route('threads.index') }}" class="text-[#0066CC] hover:text-[#003366] flex items-center mb-2">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to All Threads
                </a>
                <h1 class="text-3xl font-bold text-[#003366]">Thread with {{ $thread->user->name }}</h1>
                <p class="text-[#4A5568] mt-1">{{ $thread->user->email }}</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $thread->isOpen() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst($thread->status) }}
                </span>
            </div>
        </div>

        <!-- Team Assignment -->
        <div class="border-t border-gray-200 pt-4">
            <form action="{{ $thread->team_id ? route('threads.reassign', $thread) : route('threads.assign-team', $thread) }}" method="POST" class="flex items-end space-x-4">
                @csrf
                @method('PATCH')
                <div class="flex-1">
                    <label for="team_id" class="block text-sm font-medium text-[#003366] mb-2">
                        {{ $thread->team_id ? 'Reassign to Team' : 'Assign to Team' }}
                    </label>
                    <select name="team_id" id="team_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
                        <option value="">Select a team...</option>
                        @foreach($availableTeams as $team)
                            <option value="{{ $team->id }}" {{ $thread->team_id == $team->id ? 'selected' : '' }}>
                                {{ $team->name }} ({{ $team->users->count() }} members)
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-[#0066CC] text-white px-6 py-2 rounded-lg hover:bg-[#003366] transition-colors">
                    {{ $thread->team_id ? 'Reassign' : 'Assign' }}
                </button>
            </form>
        </div>

        <!-- Status Control -->
        <div class="border-t border-gray-200 pt-4 mt-4">
            <form action="{{ route('threads.update-status', $thread) }}" method="POST" class="flex items-center space-x-4">
                @csrf
                @method('PATCH')
                <label class="text-sm font-medium text-[#003366]">Thread Status:</label>
                <select name="status" onchange="this.form.submit()"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
                    <option value="open" {{ $thread->isOpen() ? 'selected' : '' }}>Open</option>
                    <option value="closed" {{ $thread->isClosed() ? 'selected' : '' }}>Closed</option>
                </select>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Messages -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-[#003366]">Conversation</h2>
        </div>
        
        <div id="messages-container" class="p-6 space-y-4 max-h-[600px] overflow-y-auto">
            @forelse($thread->messages as $message)
                <div class="flex {{ $message->sender_id == $thread->user_id ? 'justify-end' : 'justify-start' }}">
                    <div class="flex items-start max-w-[70%] {{ $message->sender_id == $thread->user_id ? 'flex-row-reverse' : '' }}">
                        <!-- Avatar -->
                        <div class="flex-shrink-0 {{ $message->sender_id == $thread->user_id ? 'ml-3' : 'mr-3' }}">
                            @if($message->sender->avatar)
                                <img src="{{ $message->sender->avatar }}" alt="{{ $message->sender->name }}" class="w-10 h-10 rounded-full">
                            @else
                                <div class="w-10 h-10 rounded-full {{ $message->sender_id == $thread->user_id ? 'bg-[#0066CC]' : 'bg-gray-400' }} flex items-center justify-center">
                                    <span class="text-white font-semibold">{{ substr($message->sender->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Message Bubble -->
                        <div>
                            <div class="flex items-center mb-1 {{ $message->sender_id == $thread->user_id ? 'justify-end' : '' }}">
                                <span class="text-sm font-medium text-[#003366]">{{ $message->sender->name }}</span>
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#E6F2FF] text-[#0066CC]">
                                    {{ ucfirst($message->sender_role) }}
                                </span>
                            </div>
                            <div class="rounded-lg px-4 py-3 {{ $message->sender_id == $thread->user_id ? 'bg-[#0066CC] text-white' : 'bg-gray-100 text-[#003366]' }}">
                                <p class="text-sm whitespace-pre-wrap">{{ $message->message }}</p>
                                @if($message->attachment_path)
                                    <a href="{{ route('messages.download', $message) }}" class="mt-2 inline-flex items-center text-sm {{ $message->sender_id == $thread->user_id ? 'text-white hover:text-gray-200' : 'text-[#0066CC] hover:text-[#003366]' }}">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        Attachment
                                    </a>
                                @endif
                            </div>
                            <p class="text-xs text-[#4A5568] mt-1 {{ $message->sender_id == $thread->user_id ? 'text-right' : '' }}">
                                {{ $message->created_at->format('M d, Y g:i A') }}
                            </p>
                        </div>
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

        <!-- Message Input (Admin can reply) -->
        @if($thread->isOpen())
            <div class="p-6 border-t border-gray-200 bg-gray-50">
                <form action="{{ route('messages.store', $thread) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <textarea name="message" rows="3" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent resize-none"
                                      placeholder="Type your message here..."></textarea>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <label for="attachment" class="cursor-pointer inline-flex items-center text-sm text-[#4A5568] hover:text-[#0066CC]">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                    Attach File
                                    <input type="file" name="attachment" id="attachment" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png">
                                </label>
                            </div>
                            <button type="submit" class="bg-[#0066CC] text-white px-6 py-2 rounded-lg hover:bg-[#003366] transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send Message (as Admin)
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @else
            <div class="p-6 border-t border-gray-200 bg-gray-50 text-center">
                <p class="text-[#4A5568]">This conversation has been closed. Change status to "Open" to reply.</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Auto-scroll to bottom of messages
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }

        // Show selected filename
        const fileInput = document.getElementById('attachment');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                const fileName = this.files[0]?.name;
                if (fileName) {
                    const label = this.parentElement;
                    const existingSpan = label.querySelector('span.ml-2');
                    if (existingSpan) {
                        existingSpan.remove();
                    }
                    const span = document.createElement('span');
                    span.className = 'ml-2 text-[#0066CC] font-medium';
                    span.textContent = fileName;
                    label.appendChild(span);
                }
            });
        }
    });
</script>
@endsection

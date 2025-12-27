@extends('layouts.dashboard')

@section('title', 'View Document')
@section('page-title', 'Document Details')

@section('sidebar')
    @if(auth()->user()->isAdmin())
        @include('partials.admin-sidebar')
    @else
        @include('partials.user-sidebar')
    @endif
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.index') : route('documents.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Documents
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Document Details</h1>
    </div>

    <!-- Document Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Document Header -->
        <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] px-8 py-6">
            <div class="flex items-center">
                <div class="bg-white/20 p-4 rounded-lg mr-4">
                    @php
                        $extension = strtolower(pathinfo($document->file_name, PATHINFO_EXTENSION));
                        $iconColor = match($extension) {
                            'pdf' => 'text-red-400',
                            'xlsx', 'xls' => 'text-green-400',
                            'doc', 'docx' => 'text-blue-300',
                            'jpg', 'jpeg', 'png' => 'text-purple-400',
                            default => 'text-white'
                        };
                    @endphp
                    <svg class="w-12 h-12 {{ $iconColor }}" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white">{{ $document->file_name }}</h2>
                    <p class="text-blue-100 mt-1">
                        {{ $document->type }} • {{ $document->year }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Document Information -->
        <div class="p-8 space-y-6">
            <!-- File Details -->
            <div>
                <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    File Information
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">File Name</p>
                        <p class="font-medium text-[#003366]">{{ $document->file_name }}</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">File Type</p>
                        <p class="font-medium text-[#003366]">{{ strtoupper($extension) }} ({{ $document->file_type }})</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">File Size</p>
                        <p class="font-medium text-[#003366]">{{ number_format($document->file_size / 1024, 2) }} KB</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Document Type</p>
                        <p class="font-medium text-[#003366]">{{ $document->type }}</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Year</p>
                        <p class="font-medium text-[#003366]">{{ $document->year }}</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Uploaded</p>
                        <p class="font-medium text-[#003366]">{{ $document->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
            </div>

            @if($document->description)
                <div>
                    <h3 class="text-lg font-semibold text-[#003366] mb-2">Description</h3>
                    <p class="text-[#4A5568] bg-[#F7FAFC] p-4 rounded-lg">{{ $document->description }}</p>
                </div>
            @endif

            <!-- Upload Information -->
            <div>
                <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Upload Information
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    @if(auth()->user()->isAdmin())
                        <div class="bg-[#F7FAFC] p-4 rounded-lg">
                            <p class="text-sm text-[#4A5568] mb-1">Document Owner</p>
                            <p class="font-medium text-[#003366]">{{ $document->user->name }}</p>
                            <p class="text-sm text-[#4A5568]">{{ $document->user->email }}</p>
                        </div>
                    @endif
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Uploaded By</p>
                        <p class="font-medium text-[#003366]">{{ $document->uploader->name }}</p>
                        <p class="text-sm text-[#4A5568]">{{ $document->uploader->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.download', $document) : route('documents.download', $document) }}" 
                   class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download Document
                </a>
                
                @can('delete', $document)
                    <form action="{{ auth()->user()->isAdmin() ? route('admin.documents.destroy', $document) : route('documents.destroy', $document) }}" 
                          method="POST" 
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Are you sure you want to delete this document?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Document
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection

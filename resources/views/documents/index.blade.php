@extends('layouts.dashboard')

@section('title', 'Documents')
@section('page-title', 'Documents')

@section('sidebar')
    @if(auth()->user()->isAdmin())
        @include('partials.admin-sidebar')
    @else
        @include('partials.user-sidebar')
    @endif
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Documents</h1>
            <p class="text-[#4A5568] mt-1">Manage your bookkeeping documents</p>
        </div>
        <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.create') : route('documents.create') }}" 
           class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <p class="text-white">Upload Document</p>
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

    <!-- Documents Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($documents->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F7FAFC] border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">File Name</th>
                            @if(auth()->user()->isAdmin())
                                <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">User</th>
                            @endif
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Size</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Uploaded</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($documents as $document)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="bg-[#E6F2FF] p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-[#003366]">{{ $document->file_name }}</p>
                                            @if($document->description)
                                                <p class="text-sm text-[#4A5568]">{{ Str::limit($document->description, 50) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                @if(auth()->user()->isAdmin())
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-[#003366]">{{ $document->user->name }}</p>
                                        <p class="text-xs text-[#4A5568]">{{ $document->user->email }}</p>
                                    </td>
                                @endif
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-[#E6F2FF] text-[#0066CC]">
                                        {{ strtoupper(pathinfo($document->file_name, PATHINFO_EXTENSION)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ number_format($document->file_size / 1024, 2) }} KB
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $document->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.download', $document) : route('documents.download', $document) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.edit', $document) : route('documents.edit', $document) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] p-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ auth()->user()->isAdmin() ? route('admin.documents.destroy', $document) : route('documents.destroy', $document) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this document?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $documents->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p class="text-[#4A5568] text-lg mb-4">No documents uploaded yet</p>
                <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.create') : route('documents.create') }}" 
                   class="inline-flex items-center bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Upload Your First Document
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

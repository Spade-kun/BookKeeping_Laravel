@extends('layouts.dashboard')

@section('title', 'Documents')
@section('page-title', 'My Documents')

@section('sidebar')
    @include('partials.user-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb Navigation -->
    @php
        $breadcrumbItems = [['label' => 'My Documents', 'url' => route('documents.index')]];
        if(request('year')) {
            $breadcrumbItems[] = ['label' => request('year'), 'url' => route('documents.index', ['year' => request('year')])];
        }
        if(request('type')) {
            $breadcrumbItems[] = ['label' => request('type'), 'url' => '#'];
        }
    @endphp
    <x-breadcrumb :items="$breadcrumbItems" />

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">My Documents</h1>
            <p class="text-[#4A5568] mt-1">Organize your bookkeeping documents by year and type</p>
        </div>
        <a href="{{ route('documents.create') }}" 
           class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-all transform hover:scale-105 shadow-md flex items-center">
            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="text-white">Upload Document</span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg animate-fade-in">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Filter by Year</label>
                <select onchange="window.location.href='?year='+this.value+'&type={{ request('type') }}'" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC]">
                    <option value="">All Years</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Filter by Type</label>
                <select onchange="window.location.href='?year={{ request('year') }}&type='+this.value" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC]">
                    <option value="">All Types</option>
                    @foreach($types as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Search</label>
                <x-searchbar :route="route('documents.index')" placeholder="Search documents..." :value="request('search')" />
            </div>
        </div>
        @if(request('year') || request('type') || request('search'))
            <div class="mt-4">
                <a href="{{ route('documents.index') }}" class="text-[#0066CC] hover:text-[#003366] text-sm font-medium">
                    ← Clear all filters
                </a>
            </div>
        @endif
    </div>

    <!-- Google Drive Style: Show Year Folders (Root Level) -->
    @if(!request('year') && !request('type') && !request('search'))
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Toolbar -->
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-[#003366]">Folders</h2>
                    <span class="text-sm text-[#4A5568]">{{ $folders->count() }} {{ Str::plural('folder', $folders->count()) }}</span>
                </div>
            </div>
            
            <!-- Year Folders Grid -->
            @if($folders->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach($folders as $folderYear => $folderTypes)
                            <a href="?year={{ $folderYear }}" 
                               class="group flex flex-col items-center p-6 rounded-lg border-2 border-transparent hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all cursor-pointer">
                                <div class="relative mb-3">
                                    <!-- Folder Icon -->
                                    <svg class="w-20 h-20 text-[#0066CC] group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                    </svg>
                                    <!-- Document Count Badge -->
                                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-[#0066CC] rounded-full">
                                        {{ $folderTypes->sum('count') }}
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-[#003366] text-center group-hover:text-[#0066CC] transition-colors">
                                    {{ $folderYear }}
                                </span>
                                <span class="text-xs text-[#4A5568] mt-1">
                                    {{ $folderTypes->count() }} {{ Str::plural('category', $folderTypes->count()) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-[#003366]">No folders yet</h3>
                    <p class="mt-2 text-sm text-[#4A5568]">Upload your first document to create a folder</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Google Drive Style: Show Type Folders (Year Selected) -->
    @if(request('year') && !request('type') && !request('search'))
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Toolbar -->
            <div class="border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <a href="{{ route('documents.index') }}" class="text-[#0066CC] hover:text-[#003366] mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </a>
                        <h2 class="text-lg font-semibold text-[#003366]">{{ request('year') }} - Categories</h2>
                    </div>
                    <span class="text-sm text-[#4A5568]">
                        @php
                            $yearFolders = $folders->get(request('year')) ?? collect();
                        @endphp
                        {{ $yearFolders->count() }} {{ Str::plural('category', $yearFolders->count()) }}
                    </span>
                </div>
            </div>
            
            <!-- Type Folders Grid -->
            @if($yearFolders->count() > 0)
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach($yearFolders as $folder)
                            <a href="?year={{ request('year') }}&type={{ $folder->type }}" 
                               class="group flex flex-col items-center p-6 rounded-lg border-2 border-transparent hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all cursor-pointer">
                                <div class="relative mb-3">
                                    <!-- Folder Icon -->
                                    <svg class="w-20 h-20 text-[#4A85D7] group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                                    </svg>
                                    <!-- Document Count Badge -->
                                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-[#0066CC] rounded-full">
                                        {{ $folder->count }}
                                    </span>
                                </div>
                                <span class="text-sm font-semibold text-[#003366] text-center group-hover:text-[#0066CC] transition-colors">
                                    {{ $folder->type }}
                                </span>
                                <span class="text-xs text-[#4A5568] mt-1">
                                    {{ $folder->count }} {{ Str::plural('file', $folder->count) }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-[#003366]">No categories yet</h3>
                    <p class="mt-2 text-sm text-[#4A5568]">Upload a document for {{ request('year') }} to create categories</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Documents List (Type Selected or Search) -->
    @if((request('year') && request('type')) || request('search') || ($folders->count() == 0))
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Toolbar -->
            @if(request('year') && request('type'))
                <div class="border-b border-gray-200 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <a href="?year={{ request('year') }}" class="text-[#0066CC] hover:text-[#003366] mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </a>
                            <h2 class="text-lg font-semibold text-[#003366]">{{ request('year') }} / {{ request('type') }}</h2>
                        </div>
                        <span class="text-sm text-[#4A5568]">{{ $documents->total() }} {{ Str::plural('file', $documents->total()) }}</span>
                    </div>
                </div>
            @endif
            
            <!-- Documents Table -->
            <div class="overflow-x-auto">
                @if($documents->count() > 0)
                    <table class="w-full">
                        <thead class="bg-[#F7FAFC] border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-[#003366] uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-[#003366] uppercase tracking-wider">Size</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-[#003366] uppercase tracking-wider">Modified</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-[#003366] uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($documents as $document)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <!-- File Icon based on type -->
                                            <div class="flex-shrink-0 mr-3">
                                                @php
                                                    $extension = strtolower(pathinfo($document->file_name, PATHINFO_EXTENSION));
                                                    $iconColor = match($extension) {
                                                        'pdf' => 'text-red-500',
                                                        'xlsx', 'xls' => 'text-green-600',
                                                        'doc', 'docx' => 'text-blue-600',
                                                        'jpg', 'jpeg', 'png' => 'text-purple-500',
                                                        default => 'text-gray-500'
                                                    };
                                                @endphp
                                                <svg class="w-8 h-8 {{ $iconColor }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-medium text-[#003366] truncate">{{ $document->file_name }}</p>
                                                @if($document->description)
                                                    <p class="text-xs text-[#4A5568] truncate">{{ $document->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#4A5568] whitespace-nowrap">
                                        {{ number_format($document->file_size / 1024, 1) }} KB
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#4A5568] whitespace-nowrap">
                                        {{ $document->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end space-x-1">
                                            <a href="{{ route('documents.show', $document) }}" 
                                               class="text-[#0066CC] hover:text-[#003366] p-2 rounded-lg hover:bg-[#E6F2FF] transition-colors"
                                               title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('documents.download', $document) }}" 
                                               class="text-[#0066CC] hover:text-[#003366] p-2 rounded-lg hover:bg-[#E6F2FF] transition-colors"
                                               title="Download">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('documents.destroy', $document) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to delete this document?')"
                                                        class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors"
                                                        title="Delete">
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
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-[#003366]">No documents found</h3>
                        <p class="mt-2 text-sm text-[#4A5568]">
                            @if(request('search'))
                                Try adjusting your search terms
                            @else
                                Upload your first document to get started
                            @endif
                        </p>
                    </div>
                @endif
            </div>
            
            <!-- Pagination -->
            @if($documents->hasPages())
                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

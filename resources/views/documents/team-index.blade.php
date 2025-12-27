@extends('layouts.dashboard')

@section('title', 'Documents')
@section('page-title', 'Documents')

@section('sidebar')
    @include('partials.team-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Assigned Users' Documents</h1>
            @if($team)
                <p class="text-[#4A5568] mt-1">View and download documents from users assigned to {{ $team->name }}</p>
            @else
                <p class="text-[#4A5568] mt-1">You are not assigned to a team</p>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
            <p class="text-blue-700">{{ session('info') }}</p>
        </div>
    @endif

    @if($team && $documents->isNotEmpty() || request()->has('year') || request()->has('type') || request()->has('user') || request()->has('search'))
        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form method="GET" action="{{ route('documents.index') }}" class="grid md:grid-cols-4 gap-4">
                <div>
                    <label for="user" class="block text-sm font-medium text-gray-700 mb-2">User</label>
                    <select name="user" id="user" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0066CC] focus:ring-[#0066CC]">
                        <option value="">All Users</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" {{ request('user') == $u->id ? 'selected' : '' }}>
                                {{ $u->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                    <select name="year" id="year" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0066CC] focus:ring-[#0066CC]">
                        <option value="">All Years</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select name="type" id="type" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0066CC] focus:ring-[#0066CC]">
                        <option value="">All Types</option>
                        @foreach($types as $t)
                            <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <input 
                        type="text" 
                        name="search" 
                        id="search" 
                        value="{{ request('search') }}"
                        placeholder="File name or description..."
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-[#0066CC] focus:ring-[#0066CC]"
                    >
                </div>

                <div class="md:col-span-4 flex justify-end space-x-3">
                    <a href="{{ route('documents.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Clear Filters
                    </a>
                    <button type="submit" class="bg-[#0066CC] text-white px-6 py-2 rounded-lg hover:bg-[#003366] transition-colors">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Documents List -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if($documents->isEmpty())
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p class="text-gray-500">No documents found with the selected filters</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#E6F2FF]">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">File Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">User</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Year</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Type</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Uploaded</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-[#003366]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($documents as $document)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <svg class="w-8 h-8 text-[#0066CC] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $document->file_name }}</p>
                                                @if($document->description)
                                                    <p class="text-xs text-gray-500">{{ Str::limit($document->description, 50) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-[#E6F2FF] flex items-center justify-center mr-2">
                                                <span class="text-[#0066CC] font-semibold text-xs">{{ strtoupper(substr($document->user->name, 0, 1)) }}</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $document->user->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $document->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $document->year }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#003366]">
                                            {{ $document->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $document->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('documents.download', $document) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] font-medium text-sm flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                            </svg>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($documents->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $documents->links() }}
                    </div>
                @endif
            @endif
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl shadow-md p-12">
            <div class="text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                @if($team)
                    <p class="text-gray-500">No documents from assigned users yet</p>
                @else
                    <p class="text-gray-500">You need to be assigned to a team first</p>
                    <p class="text-sm text-gray-400 mt-2">Contact your administrator to join a team</p>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection

@extends('layouts.dashboard')

@section('title', 'All Documents')
@section('page-title', 'Document Management')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Admin', 'url' => route('admin.dashboard')],
        ['label' => 'Documents', 'url' => route('admin.documents.index')]
    ]" />

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Document Management</h1>
            <p class="text-[#4A5568] mt-1">View and manage all client documents organized by user</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg animate-fade-in">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Filter by User</label>
                <select onchange="window.location.href='?user_id='+this.value+'&year={{ request('year') }}&type={{ request('type') }}'" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC]">
                    <option value="">All Users</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Filter by Year</label>
                <select onchange="window.location.href='?user_id={{ request('user_id') }}&year='+this.value+'&type={{ request('type') }}'" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC]">
                    <option value="">All Years</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Filter by Type</label>
                <select onchange="window.location.href='?user_id={{ request('user_id') }}&year={{ request('year') }}&type='+this.value" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC]">
                    <option value="">All Types</option>
                    @foreach($types as $t)
                        <option value="{{ $t }}" {{ request('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">Search</label>
                <x-searchbar :route="route('admin.documents.index')" placeholder="Search documents..." :value="request('search')" />
            </div>
        </div>
        @if(request('user_id') || request('year') || request('type') || request('search'))
            <div class="mt-4">
                <a href="{{ route('admin.documents.index') }}" class="text-[#0066CC] hover:text-[#003366] text-sm font-medium">
                    ← Clear all filters
                </a>
            </div>
        @endif
    </div>

    <!-- User Folder Structure (when no filters) -->
    @if(!request('user_id') && !request('year') && !request('type') && !request('search') && isset($userFolders) && $userFolders->count() > 0)
        <div class="space-y-6">
            @foreach($userFolders as $userId => $folders)
                @php
                    $user = $folders->first()->user;
                @endphp
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] px-6 py-4">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-3 rounded-lg mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white">{{ $user->name }}</h3>
                                <p class="text-blue-100 text-sm">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($folders->groupBy('year') as $year => $yearFolders)
                                @foreach($yearFolders as $folder)
                                    <a href="?user_id={{ $userId }}&year={{ $year }}&type={{ $folder->type }}" 
                                       class="flex items-center justify-between p-4 rounded-lg border border-gray-200 hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all group">
                                        <div class="flex items-center space-x-3">
                                            <div class="bg-[#E6F2FF] p-2 rounded-lg group-hover:bg-[#0066CC] transition-colors">
                                                <svg class="w-5 h-5 text-[#0066CC] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-[#003366] group-hover:text-[#0066CC] transition-colors">{{ $folder->type }}</p>
                                                <p class="text-xs text-[#4A5568]">{{ $year }}</p>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#0066CC]">
                                            {{ $folder->count }}
                                        </span>
                                    </a>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Documents Table -->
    @if(request('user_id') || request('year') || request('type') || request('search') || (!isset($userFolders) || $userFolders->count() == 0))
        <x-data-table 
            :headers="['User', 'Name', 'Type', 'Year', 'Size', 'Uploaded', 'Actions']"
            :pagination="$documents"
            emptyMessage="No documents found.">
            @foreach($documents as $document)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-medium text-[#003366]">{{ $document->user->name }}</p>
                            <p class="text-xs text-[#4A5568]">{{ $document->user->email }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="bg-[#E6F2FF] p-2 rounded-lg mr-3">
                                <svg class="w-5 h-5 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-[#003366]">{{ Str::limit($document->file_name, 30) }}</p>
                                @if($document->description)
                                    <p class="text-xs text-[#4A5568]">{{ Str::limit($document->description, 40) }}</p>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-[#E6F2FF] text-[#0066CC]">
                            {{ $document->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-[#003366]">{{ $document->year }}</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-[#4A5568]">
                        {{ number_format($document->file_size / 1024, 2) }} KB
                    </td>
                    <td class="px-6 py-4 text-sm text-[#4A5568]">
                        <p>{{ $document->created_at->format('M d, Y') }}</p>
                        <p class="text-xs">by {{ $document->uploader->name }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.documents.show', $document) }}" 
                               class="text-[#0066CC] hover:text-[#003366] p-2 rounded-lg hover:bg-[#E6F2FF] transition-colors"
                               title="View">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('admin.documents.download', $document) }}" 
                               class="text-[#0066CC] hover:text-[#003366] p-2 rounded-lg hover:bg-[#E6F2FF] transition-colors"
                               title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.documents.destroy', $document) }}" method="POST" class="inline">
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
        </x-data-table>
    @endif
</div>
@endsection

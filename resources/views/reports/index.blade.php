@extends('layouts.dashboard')

@section('title', 'Reports')
@section('page-title', 'Reports')

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
            <h1 class="text-3xl font-bold text-[#003366]">Financial Reports</h1>
            <p class="text-[#4A5568] mt-1">
                @if(auth()->user()->isAdmin())
                    @if(isset($selectedUser))
                        Reports for {{ $selectedUser->name }}
                    @else
                        Browse reports by user
                    @endif
                @else
                    View and download your bookkeeping reports
                @endif
            </p>
        </div>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.reports.create') }}" 
               class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <p class="text-white"> Create Report</p>
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Breadcrumb Navigation for Admin -->
    @if(auth()->user()->isAdmin() && isset($selectedUser))
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('admin.reports.index') }}" class="text-[#0066CC] hover:text-[#003366] font-medium">
                All Users
            </a>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-[#4A5568] font-medium">{{ $selectedUser->name }}</span>
        </nav>
    @endif

    @if(auth()->user()->isAdmin() && !isset($selectedUser))
        <!-- User Folders View -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($usersWithReports as $userWithReports)
                @php
                    $reportCount = \App\Models\Report::where('user_id', $userWithReports->id)->count();
                @endphp
                <a href="{{ route('admin.reports.index', ['user' => $userWithReports->id]) }}" 
                   class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all p-6 group">
                    <div class="flex items-center space-x-4">
                        <div class="bg-gradient-to-br from-[#0066CC] to-[#003366] p-4 rounded-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-[#003366] text-lg group-hover:text-[#0066CC] transition-colors">
                                {{ $userWithReports->name }}
                            </h3>
                            <p class="text-sm text-[#4A5568]">{{ $userWithReports->email }}</p>
                            <div class="flex items-center mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#E6F2FF] text-[#0066CC]">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    {{ $reportCount }} {{ Str::plural('report', $reportCount) }}
                                </span>
                            </div>
                        </div>
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-[#0066CC] group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-white rounded-xl shadow-md p-16 text-center">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-[#4A5568] text-lg">No reports available yet</p>
                    <p class="text-[#4A5568] text-sm mt-2">Create a report to get started</p>
                </div>
            @endforelse
        </div>
    @else
        <!-- Reports Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            @if($reports && $reports->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#F7FAFC] border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Title</th>
                                @if(auth()->user()->isAdmin() && !isset($selectedUser))
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">User</th>
                                @endif
                                <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Period</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Description</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Date Range</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($reports as $report)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="bg-[#E6F2FF] p-2 rounded-lg mr-3">
                                                <svg class="w-5 h-5 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                                </svg>
                                            </div>
                                            <p class="font-medium text-[#003366]">{{ $report->title }}</p>
                                        </div>
                                    </td>
                                    @if(auth()->user()->isAdmin() && !isset($selectedUser))
                                        <td class="px-6 py-4">
                                            <p class="text-sm text-[#003366]">{{ $report->user->name }}</p>
                                        </td>
                                    @endif
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-[#E6F2FF] text-[#0066CC]">
                                            {{ ucfirst($report->report_type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#4A5568]">
                                        {{ $report->period }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($report->description)
                                            <p class="text-sm text-[#4A5568] max-w-xs truncate" title="{{ $report->description }}">
                                                {{ Str::limit($report->description, 50) }}
                                            </p>
                                        @else
                                            <span class="text-gray-400 text-sm">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#4A5568]">
                                        {{ $report->start_date->format('M d, Y') }} - {{ $report->end_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end space-x-2">
                                            @if($report->file_path)
                                                <a href="{{ auth()->user()->isAdmin() ? route('admin.reports.download', $report) : route('reports.download', $report) }}" 
                                                   class="text-[#0066CC] hover:text-[#003366] p-2" title="Download">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                            @if(auth()->user()->isAdmin())
                                                <a href="{{ route('admin.reports.edit', $report) }}" 
                                                   class="text-[#0066CC] hover:text-[#003366] p-2" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </a>
                                                <form action="{{ route('admin.reports.destroy', $report) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2" title="Delete">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reports->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-[#4A5568] text-lg">No reports available yet</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection

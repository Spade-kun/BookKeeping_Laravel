@extends('layouts.dashboard')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.users.index') }}" 
               class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Users
            </a>
            <h1 class="text-3xl font-bold text-[#003366]">User Details</h1>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.users.edit', $user) }}" 
               class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <p class="text-white">Edit User</p>
            </a>
        </div>
    </div>

    <!-- User Profile Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] px-8 py-12">
            <div class="flex items-center space-x-6">
                @if($user->google_avatar)
                    <img src="{{ $user->google_avatar }}" 
                         alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-white flex items-center justify-center">
                        <span class="text-3xl font-bold text-[#0066CC]">
                            {{ substr($user->name, 0, 1) }}
                        </span>
                    </div>
                @endif
                <div>
                    <h2 class="text-3xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-blue-100 mt-1">{{ $user->email }}</p>
                    <div class="mt-2 flex items-center space-x-2">
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-white/20 text-white">
                            {{ ucfirst($user->role) }}
                        </span>
                        @if($user->activeSubscription)
                            <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-green-500 text-white">
                                Active Subscription
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-[#F7FAFC] p-4 rounded-lg">
                    <p class="text-sm text-[#4A5568] mb-1">Member Since</p>
                    <p class="font-medium text-[#003366]">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
                <div class="bg-[#F7FAFC] p-4 rounded-lg">
                    <p class="text-sm text-[#4A5568] mb-1">Total Documents</p>
                    <p class="font-medium text-[#003366]">{{ $user->documents()->count() }}</p>
                </div>
                <div class="bg-[#F7FAFC] p-4 rounded-lg">
                    <p class="text-sm text-[#4A5568] mb-1">Total Reports</p>
                    <p class="font-medium text-[#003366]">{{ $user->reports()->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Details -->
    @if($user->activeSubscription)
        <div class="bg-white rounded-xl shadow-md p-8">
            <h3 class="text-xl font-semibold text-[#003366] mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Current Subscription
            </h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-[#E6F2FF] border border-[#0066CC] p-6 rounded-lg">
                    <p class="text-2xl font-bold text-[#003366] mb-2">{{ $user->activeSubscription->plan->name }}</p>
                    <p class="text-[#4A5568]">
                        ${{ number_format($user->activeSubscription->plan->price, 2) }} / 
                        {{ $user->activeSubscription->plan->billing_period }}
                    </p>
                    <div class="mt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-[#4A5568]">Start Date:</span>
                            <span class="font-medium text-[#003366]">{{ $user->activeSubscription->started_at ? \Carbon\Carbon::parse($user->activeSubscription->started_at)->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#4A5568]">End Date:</span>
                            <span class="font-medium text-[#003366]">{{ $user->activeSubscription->ends_at ? \Carbon\Carbon::parse($user->activeSubscription->ends_at)->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-[#4A5568]">Status:</span>
                            <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $user->activeSubscription->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($user->activeSubscription->status) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="bg-[#F7FAFC] p-6 rounded-lg">
                    <p class="text-sm font-medium text-[#003366] mb-3">Plan Features</p>
                    <ul class="space-y-2">
                        @foreach($user->activeSubscription->plan->features as $feature)
                            <li class="flex items-start text-sm">
                                <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-[#4A5568]">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @else
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-8 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            <p class="text-[#4A5568]">This user does not have an active subscription</p>
        </div>
    @endif

    <!-- Recent Documents -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-xl font-semibold text-[#003366] mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Recent Documents
        </h3>
        @if($user->documents()->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F7FAFC]">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">File Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">Size</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">Uploaded</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($user->documents()->latest()->take(5)->get() as $document)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-[#003366]">{{ $document->file_name }}</td>
                                <td class="px-4 py-3 text-sm text-[#4A5568]">{{ number_format($document->file_size / 1024, 2) }} KB</td>
                                <td class="px-4 py-3 text-sm text-[#4A5568]">{{ $document->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-[#4A5568] text-center py-8">No documents uploaded</p>
        @endif
    </div>

    <!-- Recent Reports -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-xl font-semibold text-[#003366] mb-6 flex items-center">
            <svg class="w-6 h-6 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Recent Reports
        </h3>
        @if($user->reports()->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F7FAFC]">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">Period</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-[#4A5568] uppercase">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($user->reports()->latest()->take(5)->get() as $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-[#003366]">{{ $report->title }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full bg-[#E6F2FF] text-[#0066CC]">
                                        {{ ucfirst($report->report_type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-[#4A5568]">{{ $report->period }}</td>
                                <td class="px-4 py-3 text-sm text-[#4A5568]">{{ $report->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-[#4A5568] text-center py-8">No reports generated</p>
        @endif
    </div>
</div>
@endsection

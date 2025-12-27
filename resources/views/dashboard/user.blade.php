@extends('layouts.dashboard')

@section('title', 'User Dashboard')
@section('page-title', 'Dashboard')

@section('sidebar')
    @include('partials.user-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] rounded-2xl p-8 text-white shadow-xl">
        <h2 class="text-3xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="text-blue-100">Here's an overview of your account and bookkeeping services.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-[#003366]">{{ $stats['documents'] ?? 0 }}</h3>
            <p class="text-[#4A5568] text-sm">Documents</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-[#003366]">{{ $stats['reports'] ?? 0 }}</h3>
            <p class="text-[#4A5568] text-sm">Reports</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-[#003366]">
                @if(isset($stats['nextReview']) && $stats['nextReview'])
                    {{ $stats['nextReview']->format('M d, Y') }}
                @else
                    -
                @endif
            </h3>
            <p class="text-[#4A5568] text-sm">Next Review</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl p-8 shadow-md">
        <h3 class="text-xl font-bold text-[#003366] mb-6">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <button class="flex items-center p-4 border-2 border-[#E2E8F0] rounded-lg hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all">
                <div class="bg-[#E6F2FF] p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-[#003366]">Upload Documents</p>
                    <p class="text-sm text-[#4A5568]">Add receipts or invoices</p>
                </div>
            </button>
            
            <button class="flex items-center p-4 border-2 border-[#E2E8F0] rounded-lg hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all">
                <div class="bg-[#E6F2FF] p-3 rounded-lg mr-4">
                    <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-[#003366]">Contact Support</p>
                    <p class="text-sm text-[#4A5568]">Get help from our team</p>
                </div>
            </button>
        </div>
    </div>

    <!-- Account Info -->
    <div class="bg-white rounded-xl p-8 shadow-md">
        <h3 class="text-xl font-bold text-[#003366] mb-6">Account Information</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                <span class="text-[#4A5568]">Name</span>
                <span class="font-medium text-[#003366]">{{ auth()->user()->name }}</span>
            </div>
            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                <span class="text-[#4A5568]">Email</span>
                <span class="font-medium text-[#003366]">{{ auth()->user()->email }}</span>
            </div>
            <div class="flex items-center justify-between py-3 border-b border-gray-100">
                <span class="text-[#4A5568]">Account Type</span>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-[#E6F2FF] text-[#0066CC]">
                    User
                </span>
            </div>
            <div class="flex items-center justify-between py-3">
                <span class="text-[#4A5568]">Member Since</span>
                <span class="font-medium text-[#003366]">{{ auth()->user()->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

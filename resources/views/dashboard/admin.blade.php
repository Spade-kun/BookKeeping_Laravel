@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
        <p class="text-white">Dashboard</p>
    </a>
    <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.users.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <p class="text-white">Users</p>
    </a>
    <a href="{{ route('admin.documents.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.documents.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <p class="text-white">Documents</p>
    </a>
    <a href="{{ route('admin.reports.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.reports.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
        </svg>
        <p class="text-white">Reports</p>
    </a>
    <a href="{{ route('admin.transactions.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-white">Transactions</p>
    </a>
    <a href="{{ route('admin.plans.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.plans.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
        </svg>
        <p class="text-white">Plans</p>
    </a>
    <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.subscriptions.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
        </svg>
        <p class="text-white">Subscriptions</p>
    </a>
    <a href="{{ route('admin.profile.show') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('admin.profile.*') ? 'bg-[#0066CC]' : 'text-blue-200 hover:bg-blue-900' }} rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        <p class="text-white">Profile</p>
    </a>
    <a href="#" class="flex items-center px-4 py-3 text-blue-200 hover:bg-blue-900 rounded-lg transition-colors">
        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        <p class="text-white">Settings</p>
    </a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] rounded-2xl p-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold mb-2">Admin Dashboard</h2>
                <p class="text-blue-100">Manage users, settings, and system overview.</p>
            </div>
            <div class="bg-white bg-opacity-20 p-4 rounded-lg">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border-l-4 border-[#0066CC]">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-[#003366]">{{ $stats['total_users'] }}</h3>
            <p class="text-[#4A5568] text-sm">Total Users</p>
        </div>

        <!-- Admin Count -->
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border-l-4 border-[#34A853]">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-[#003366]">{{ $stats['total_admins'] }}</h3>
            <p class="text-[#4A5568] text-sm">Administrators</p>
        </div>

        <!-- Regular Users -->
        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow border-l-4 border-[#FBBC05]">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-[#003366]">{{ $stats['total_regular_users'] }}</h3>
            <p class="text-[#4A5568] text-sm">Regular Users</p>
        </div>
    </div>

    <!-- Management Widgets -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- User Management -->
        <div class="bg-white rounded-xl p-8 shadow-md">
            <h3 class="text-xl font-bold text-[#003366] mb-6">User Management</h3>
            <div class="space-y-4">
                <button class="w-full flex items-center justify-between p-4 border-2 border-[#E2E8F0] rounded-lg hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#0066CC] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium text-[#003366]">View All Users</span>
                    </div>
                    <svg class="w-5 h-5 text-[#4A5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <button class="w-full flex items-center justify-between p-4 border-2 border-[#E2E8F0] rounded-lg hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#0066CC] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="font-medium text-[#003366]">Manage Roles</span>
                    </div>
                    <svg class="w-5 h-5 text-[#4A5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- System Settings -->
        <div class="bg-white rounded-xl p-8 shadow-md">
            <h3 class="text-xl font-bold text-[#003366] mb-6">System Settings</h3>
            <div class="space-y-4">
                <button class="w-full flex items-center justify-between p-4 border-2 border-[#E2E8F0] rounded-lg hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#0066CC] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium text-[#003366]">General Settings</span>
                    </div>
                    <svg class="w-5 h-5 text-[#4A5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <button class="w-full flex items-center justify-between p-4 border-2 border-[#E2E8F0] rounded-lg hover:border-[#0066CC] hover:bg-[#F7FAFC] transition-all">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-[#0066CC] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="font-medium text-[#003366]">View Analytics</span>
                    </div>
                    <svg class="w-5 h-5 text-[#4A5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Recent Activity Placeholder -->
    <div class="bg-white rounded-xl p-8 shadow-md">
        <h3 class="text-xl font-bold text-[#003366] mb-6">Recent Activity</h3>
        <div class="text-center py-12">
            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <p class="text-[#4A5568]">No recent activity to display</p>
        </div>
    </div>
</div>
@endsection

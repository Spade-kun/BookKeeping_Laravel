@extends('layouts.dashboard')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">User Management</h1>
            <p class="text-[#4A5568] mt-1">Manage all users and their subscriptions</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Total Users</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $stats['total_users'] }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Active Subscriptions</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['active_subscriptions'] }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Admins</p>
                    <p class="text-3xl font-bold text-[#0066CC] mt-1">{{ $stats['total_admins'] }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Regular Users</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $stats['total_regular_users'] }}</p>
                </div>
                <div class="bg-[#F7FAFC] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#4A5568]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F7FAFC] border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Subscription</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Documents</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Joined</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($user->google_avatar)
                                            <img src="{{ $user->google_avatar }}" 
                                                 alt="{{ $user->name }}"
                                                 class="w-10 h-10 rounded-full mr-3">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-[#E6F2FF] flex items-center justify-center mr-3">
                                                <span class="text-[#0066CC] font-semibold">
                                                    {{ substr($user->name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-[#003366]">{{ $user->name }}</p>
                                            <p class="text-sm text-[#4A5568]">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->activeSubscription)
                                        <div>
                                            <p class="font-medium text-[#003366]">{{ $user->activeSubscription->plan->name }}</p>
                                            <p class="text-xs text-[#4A5568]">Expires {{ $user->activeSubscription->ends_at ? \Carbon\Carbon::parse($user->activeSubscription->ends_at)->format('M d, Y') : 'N/A' }}</p>
                                        </div>
                                    @else
                                        <span class="text-sm text-[#4A5568]">No subscription</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $user->documents()->count() ?? 0 }} files
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.users.show', $user) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] p-2"
                                           title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] p-2"
                                           title="Edit User">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this user? All associated data will be removed.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 p-2"
                                                    title="Delete User">
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

            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <p class="text-[#4A5568] text-lg">No users found</p>
            </div>
        @endif
    </div>
</div>
@endsection

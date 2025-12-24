@extends('layouts.dashboard')

@section('title', 'Subscription Management')
@section('page-title', 'Subscription Management')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Subscription Management</h1>
            <p class="text-[#4A5568] mt-1">Manage user subscriptions and plans</p>
        </div>
        <a href="{{ route('admin.subscriptions.create') }}" 
           class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Subscription
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

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Total Subscriptions</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $totalSubscriptions }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Active</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $activeSubscriptions }}</p>
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
                    <p class="text-sm text-[#4A5568]">Expired</p>
                    <p class="text-3xl font-bold text-gray-600 mt-1">{{ $expiredSubscriptions }}</p>
                </div>
                <div class="bg-gray-50 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Cancelled</p>
                    <p class="text-3xl font-bold text-red-600 mt-1">{{ $cancelledSubscriptions }}</p>
                </div>
                <div class="bg-red-50 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <form method="GET" action="{{ route('admin.subscriptions.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search by user name or email..." 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
            </div>
            <div class="w-full md:w-48">
                <select name="status" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <button type="submit" 
                    class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors">
                Filter
            </button>
            @if(request('search') || request('status'))
                <a href="{{ route('admin.subscriptions.index') }}" 
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors text-center">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Subscriptions Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @if($subscriptions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F7FAFC] border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Plan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Start Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">End Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($subscriptions as $subscription)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($subscription->user->google_avatar)
                                            <img src="{{ $subscription->user->google_avatar }}" 
                                                 alt="{{ $subscription->user->name }}"
                                                 class="w-10 h-10 rounded-full mr-3">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-[#E6F2FF] flex items-center justify-center mr-3">
                                                <span class="text-[#0066CC] font-semibold">
                                                    {{ substr($subscription->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-medium text-[#003366]">{{ $subscription->user->name }}</p>
                                            <p class="text-sm text-[#4A5568]">{{ $subscription->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-[#003366]">{{ $subscription->plan->name }}</p>
                                    <p class="text-xs text-[#4A5568]">${{ number_format($subscription->plan->price, 2) }} / {{ $subscription->plan->billing_period }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($subscription->status == 'active')
                                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @elseif($subscription->status == 'expired')
                                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                            Expired
                                        </span>
                                    @elseif($subscription->status == 'cancelled')
                                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            Cancelled
                                        </span>
                                    @elseif($subscription->status == 'pending')
                                        <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $subscription->started_at ? $subscription->started_at->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $subscription->ends_at ? $subscription->ends_at->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-[#003366]">${{ number_format($subscription->plan->price, 2) }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('admin.subscriptions.show', $subscription) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] p-2"
                                           title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.subscriptions.edit', $subscription) }}" 
                                           class="text-[#0066CC] hover:text-[#003366] p-2"
                                           title="Edit Subscription">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        @if($subscription->status == 'active')
                                            <form action="{{ route('admin.subscriptions.cancel', $subscription) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Are you sure you want to cancel this active subscription?');">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="text-yellow-600 hover:text-yellow-800 p-2"
                                                        title="Cancel Subscription">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this subscription? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 p-2"
                                                    title="Delete Subscription">
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
                {{ $subscriptions->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                <p class="text-[#4A5568] text-lg">No subscriptions found</p>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.subscriptions.index') }}" 
                       class="inline-block mt-4 text-[#0066CC] hover:text-[#003366] font-medium">
                        Clear filters
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection

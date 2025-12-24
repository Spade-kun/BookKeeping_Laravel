@extends('layouts.dashboard')

@section('title', 'Subscription Details')
@section('page-title', 'Subscription Details')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.subscriptions.index') }}" 
               class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Subscriptions
            </a>
            <h1 class="text-3xl font-bold text-[#003366]">Subscription Details</h1>
            <p class="text-[#4A5568] mt-1">View complete subscription information</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.subscriptions.edit', $subscription) }}" 
               class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- User Information Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] px-8 py-8">
            <div class="flex items-center space-x-6">
                @if($subscription->user->google_avatar)
                    <img src="{{ $subscription->user->google_avatar }}" 
                         alt="{{ $subscription->user->name }}"
                         class="w-20 h-20 rounded-full border-4 border-white shadow-lg">
                @else
                    <div class="w-20 h-20 rounded-full border-4 border-white shadow-lg bg-white flex items-center justify-center">
                        <span class="text-3xl font-bold text-[#0066CC]">
                            {{ substr($subscription->user->name, 0, 1) }}
                        </span>
                    </div>
                @endif
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-white">{{ $subscription->user->name }}</h2>
                    <p class="text-blue-100 mt-1">{{ $subscription->user->email }}</p>
                    <div class="mt-3">
                        @if($subscription->status == 'active')
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                Active Subscription
                            </span>
                        @elseif($subscription->status == 'expired')
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full bg-gray-100 text-gray-800">
                                Expired Subscription
                            </span>
                        @elseif($subscription->status == 'cancelled')
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full bg-red-100 text-red-800">
                                Cancelled Subscription
                            </span>
                        @elseif($subscription->status == 'pending')
                            <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full bg-yellow-100 text-yellow-800">
                                Pending Subscription
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                User Information
            </h3>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-[#F7FAFC] p-4 rounded-lg">
                    <p class="text-sm text-[#4A5568] mb-1">Account Type</p>
                    <p class="font-medium text-[#003366]">{{ ucfirst($subscription->user->role) }}</p>
                </div>
                <div class="bg-[#F7FAFC] p-4 rounded-lg">
                    <p class="text-sm text-[#4A5568] mb-1">Member Since</p>
                    <p class="font-medium text-[#003366]">{{ $subscription->user->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Plan Details -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-lg font-semibold text-[#003366] mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
            </svg>
            Plan Details
        </h3>

        <div class="bg-[#E6F2FF] border border-[#0066CC] p-6 rounded-lg mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-2xl font-bold text-[#003366]">{{ $subscription->plan->name }}</p>
                    <p class="text-[#4A5568] mt-1">
                        ${{ number_format($subscription->plan->price, 2) }} / {{ $subscription->plan->billing_period }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-[#4A5568]">Total Value</p>
                    <p class="text-2xl font-bold text-[#0066CC]">${{ number_format($subscription->plan->price, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Billing Period</p>
                <p class="font-medium text-[#003366]">{{ ucfirst($subscription->plan->billing_period) }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Transaction Limit</p>
                <p class="font-medium text-[#003366]">{{ $subscription->plan->transaction_limit ?? 'Unlimited' }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Accounts Supported</p>
                <p class="font-medium text-[#003366]">{{ $subscription->plan->accounts_supported ?? 'Multiple' }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Support Level</p>
                <p class="font-medium text-[#003366]">{{ ucfirst($subscription->plan->support_level ?? 'Standard') }}</p>
            </div>
        </div>

        @if($subscription->plan->features && is_array($subscription->plan->features))
            <div>
                <h4 class="font-semibold text-[#003366] mb-3">Plan Features</h4>
                <ul class="space-y-2">
                    @foreach($subscription->plan->features as $feature)
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-[#4A5568]">{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Subscription Timeline -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-lg font-semibold text-[#003366] mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Subscription Timeline
        </h3>

        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>

            <!-- Timeline Items -->
            <div class="space-y-8">
                <!-- Start Date -->
                @if($subscription->started_at)
                    <div class="relative flex items-start ml-12">
                        <div class="absolute -left-12 w-8 h-8 rounded-full bg-[#0066CC] flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="bg-[#F7FAFC] p-4 rounded-lg flex-1">
                            <p class="font-semibold text-[#003366]">Subscription Started</p>
                            <p class="text-sm text-[#4A5568] mt-1">{{ $subscription->started_at->format('F d, Y g:i A') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Current Status -->
                <div class="relative flex items-start ml-12">
                    <div class="absolute -left-12 w-8 h-8 rounded-full bg-[#0066CC] flex items-center justify-center border-4 border-white shadow-lg">
                        <div class="w-3 h-3 rounded-full bg-white"></div>
                    </div>
                    <div class="bg-[#E6F2FF] border border-[#0066CC] p-4 rounded-lg flex-1">
                        <p class="font-semibold text-[#003366]">Current Status</p>
                        <p class="text-sm text-[#4A5568] mt-1">
                            <span class="font-medium">{{ ucfirst($subscription->status) }}</span> as of {{ now()->format('F d, Y') }}
                        </p>
                    </div>
                </div>

                <!-- End Date -->
                @if($subscription->ends_at)
                    <div class="relative flex items-start ml-12">
                        <div class="absolute -left-12 w-8 h-8 rounded-full {{ $subscription->ends_at->isPast() ? 'bg-gray-400' : 'bg-[#0066CC]' }} flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="bg-[#F7FAFC] p-4 rounded-lg flex-1">
                            <p class="font-semibold text-[#003366]">
                                {{ $subscription->ends_at->isPast() ? 'Subscription Ended' : 'Subscription Ends' }}
                            </p>
                            <p class="text-sm text-[#4A5568] mt-1">{{ $subscription->ends_at->format('F d, Y') }}</p>
                            @if(!$subscription->ends_at->isPast())
                                <p class="text-xs text-[#0066CC] mt-1">{{ $subscription->ends_at->diffForHumans() }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Cancellation Date -->
                @if($subscription->cancelled_at)
                    <div class="relative flex items-start ml-12">
                        <div class="absolute -left-12 w-8 h-8 rounded-full bg-red-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="bg-red-50 border border-red-200 p-4 rounded-lg flex-1">
                            <p class="font-semibold text-red-800">Subscription Cancelled</p>
                            <p class="text-sm text-red-600 mt-1">{{ $subscription->cancelled_at->format('F d, Y g:i A') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Subscription Metadata -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Additional Information
        </h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Subscription ID</p>
                <p class="font-medium text-[#003366] font-mono">#{{ $subscription->id }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Created At</p>
                <p class="font-medium text-[#003366]">{{ $subscription->created_at->format('F d, Y g:i A') }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Last Updated</p>
                <p class="font-medium text-[#003366]">{{ $subscription->updated_at->format('F d, Y g:i A') }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Duration</p>
                <p class="font-medium text-[#003366]">
                    @if($subscription->started_at && $subscription->ends_at)
                        {{ $subscription->started_at->diffInDays($subscription->ends_at) }} days
                    @else
                        N/A
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-[#003366]">Actions</h3>
                <p class="text-sm text-[#4A5568] mt-1">Manage this subscription</p>
            </div>
            <div class="flex items-center space-x-3">
                @if($subscription->status == 'active')
                    <form action="{{ route('admin.subscriptions.cancel', $subscription) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to cancel this active subscription?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                            Cancel Subscription
                        </button>
                    </form>
                @endif
                <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" 
                      method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this subscription? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Subscription
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

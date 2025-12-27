@extends('layouts.dashboard')

@section('title', 'Plan Details')
@section('page-title', 'Plan Details')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.plans.index') }}" 
               class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Plans
            </a>
            <div class="flex items-center space-x-3">
                <h1 class="text-3xl font-bold text-[#003366]">{{ $plan->name }}</h1>
                @if($plan->is_active)
                    <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">Active</span>
                @else
                    <span class="px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">Inactive</span>
                @endif
                @if($plan->name == 'Professional')
                    <span class="px-3 py-1 bg-[#0066CC] text-white text-sm font-medium rounded-full">POPULAR</span>
                @endif
            </div>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.plans.edit', $plan) }}" 
               class="inline-flex items-center px-4 py-2 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Plan
            </a>
            <form action="{{ route('admin.plans.destroy', $plan) }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this plan? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Plan Details Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-[#003366] mb-4">Pricing Information</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-[#4A5568]">Price:</span>
                                <span class="text-2xl font-bold text-[#0066CC]">${{ number_format($plan->price, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#4A5568]">Billing Cycle:</span>
                                <span class="font-medium text-[#003366] capitalize">{{ $plan->billing_period }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#4A5568]">Status:</span>
                                <span class="font-medium {{ $plan->is_active ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-[#003366] mb-4">Statistics</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-[#4A5568]">Active Subscribers:</span>
                                <span class="font-bold text-[#0066CC]">{{ $plan->subscriptions->where('status', 'active')->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#4A5568]">Total Subscriptions:</span>
                                <span class="font-medium text-[#003366]">{{ $plan->subscriptions_count }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#4A5568]">Monthly Revenue:</span>
                                <span class="font-medium text-green-600">
                                    ${{ number_format($plan->subscriptions->where('status', 'active')->count() * ($plan->billing_period == 'monthly' ? $plan->price : $plan->price / 12), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <h3 class="text-lg font-semibold text-[#003366] mb-4">Plan Features</h3>
                    <ul class="space-y-3">
                        @foreach($plan->features as $feature)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-[#4A5568]">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Subscriptions -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-[#003366]">Recent Subscriptions</h2>
            <p class="text-sm text-[#4A5568] mt-1">Users who subscribed to this plan</p>
        </div>

        @if($plan->subscriptions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#F7FAFC] border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Started</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Expires</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-[#4A5568] uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($plan->subscriptions->sortByDesc('created_at')->take(10) as $subscription)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-[#E6F2FF] rounded-full flex items-center justify-center">
                                            <span class="text-[#0066CC] font-semibold text-sm">
                                                {{ substr($subscription->user->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-[#003366]">{{ $subscription->user->name }}</p>
                                            <p class="text-sm text-[#4A5568]">{{ $subscription->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($subscription->status == 'active')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                                    @elseif($subscription->status == 'cancelled')
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">Cancelled</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full capitalize">{{ $subscription->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $subscription->started_at ? $subscription->started_at->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-[#4A5568]">
                                    {{ $subscription->ends_at ? $subscription->ends_at->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.users.show', $subscription->user) }}" 
                                       class="text-[#0066CC] hover:text-[#003366] text-sm font-medium">
                                        View User
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($plan->subscriptions->count() > 10)
                <div class="px-8 py-4 bg-[#F7FAFC] border-t border-gray-200 text-center">
                    <p class="text-sm text-[#4A5568]">
                        Showing 10 of {{ $plan->subscriptions->count() }} total subscriptions
                    </p>
                </div>
            @endif
        @else
            <div class="px-8 py-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                <h3 class="text-lg font-medium text-[#4A5568] mb-2">No Subscriptions Yet</h3>
                <p class="text-[#4A5568]">This plan doesn't have any subscribers yet</p>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Plan Management')
@section('page-title', 'Plan Management')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Plan Management</h1>
            <p class="text-[#4A5568] mt-1">Manage subscription plans and pricing</p>
        </div>
        <a href="{{ route('admin.plans.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create New Plan
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
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Total Plans</p>
                    <p class="text-3xl font-bold text-[#003366] mt-1">{{ $plans->count() }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#4A5568]">Active Plans</p>
                    <p class="text-3xl font-bold text-green-600 mt-1">{{ $plans->where('is_active', true)->count() }}</p>
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
                    <p class="text-sm text-[#4A5568]">Total Subscribers</p>
                    <p class="text-3xl font-bold text-[#0066CC] mt-1">{{ $plans->sum('subscriptions_count') }}</p>
                </div>
                <div class="bg-[#E6F2FF] p-3 rounded-lg">
                    <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Plans Grid -->
    <div class="grid md:grid-cols-3 gap-6">
        @forelse($plans as $plan)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-2xl {{ $plan->name == 'Professional' ? 'ring-4 ring-[#0066CC]' : '' }}">
                @if($plan->name == 'Professional')
                    <div class="bg-[#0066CC] text-white text-center py-2 text-sm font-medium">
                        MOST POPULAR
                    </div>
                @endif
                
                <div class="p-8">
                    <!-- Plan Header -->
                    <div class="text-center mb-6">
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <h3 class="text-2xl font-bold text-[#003366]">{{ $plan->name }}</h3>
                            @if($plan->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Inactive</span>
                            @endif
                        </div>
                        <div class="flex items-baseline justify-center">
                            <span class="text-4xl font-extrabold text-[#0066CC]">${{ number_format($plan->price, 2) }}</span>
                            <span class="text-[#4A5568] ml-2">/{{ $plan->billing_cycle }}</span>
                        </div>
                        <p class="text-sm text-[#4A5568] mt-2">{{ $plan->subscriptions_count }} subscriber{{ $plan->subscriptions_count != 1 ? 's' : '' }}</p>
                    </div>

                    <!-- Features List -->
                    <ul class="space-y-3 mb-8 min-h-[200px]">
                        @foreach($plan->features as $feature)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-[#4A5568] text-sm">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <a href="{{ route('admin.plans.show', $plan) }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-[#0066CC] text-[#0066CC] rounded-lg hover:bg-[#E6F2FF] transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View Details
                        </a>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.plans.edit', $plan) }}" 
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.plans.destroy', $plan) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this plan? This action cannot be undone.');"
                                  class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-xl shadow-md p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="text-xl font-medium text-[#4A5568] mb-2">No plans yet</h3>
                <p class="text-[#4A5568] mb-4">Get started by creating your first subscription plan</p>
                <a href="{{ route('admin.plans.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Your First Plan
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection

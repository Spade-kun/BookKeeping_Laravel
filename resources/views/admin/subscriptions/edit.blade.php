@extends('layouts.dashboard')

@section('title', 'Edit Subscription')
@section('page-title', 'Edit Subscription')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ route('admin.subscriptions.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Subscriptions
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Edit Subscription</h1>
        <p class="text-[#4A5568] mt-1">Update subscription details for {{ $subscription->user->name }}</p>
    </div>

    <!-- Warning for Active Subscription -->
    @if($subscription->status == 'active')
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-yellow-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <div>
                    <p class="font-medium text-yellow-800">Active Subscription Warning</p>
                    <p class="text-sm text-yellow-700 mt-1">You are editing an active subscription. Changes may affect the user's access immediately. Please proceed with caution.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.subscriptions.update', $subscription) }}" 
              method="POST" 
              class="space-y-6"
              id="subscriptionForm">
            @csrf
            @method('PUT')

            <!-- User Selection -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-[#003366] mb-2">
                    User <span class="text-red-500">*</span>
                </label>
                <select name="user_id" 
                        id="user_id"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('user_id') border-red-500 @enderror">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $subscription->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">The user who owns this subscription</p>
            </div>

            <!-- Plan Selection -->
            <div>
                <label for="plan_id" class="block text-sm font-medium text-[#003366] mb-2">
                    Plan <span class="text-red-500">*</span>
                </label>
                <select name="plan_id" 
                        id="plan_id"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('plan_id') border-red-500 @enderror">
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" 
                                data-price="{{ $plan->price }}"
                                data-billing-period="{{ $plan->billing_period }}"
                                {{ old('plan_id', $subscription->plan_id) == $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }} - ${{ number_format($plan->price, 2) }} / {{ $plan->billing_period }}
                        </option>
                    @endforeach
                </select>
                @error('plan_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">Change the subscription plan if needed</p>
            </div>

            <!-- Current Plan Info -->
            <div class="bg-[#E6F2FF] border border-[#0066CC] p-4 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-[#0066CC] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="font-medium text-[#003366]">Current Plan</p>
                        <p class="text-sm text-[#4A5568] mt-1">
                            {{ $subscription->plan->name }} - ${{ number_format($subscription->plan->price, 2) }} / {{ $subscription->plan->billing_period }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Start Date -->
            <div>
                <label for="started_at" class="block text-sm font-medium text-[#003366] mb-2">
                    Start Date <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       name="started_at" 
                       id="started_at" 
                       value="{{ old('started_at', $subscription->started_at ? $subscription->started_at->format('Y-m-d') : '') }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('started_at') border-red-500 @enderror">
                @error('started_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">When the subscription began</p>
            </div>

            <!-- End Date -->
            <div>
                <label for="ends_at" class="block text-sm font-medium text-[#003366] mb-2">
                    End Date <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       name="ends_at" 
                       id="ends_at" 
                       value="{{ old('ends_at', $subscription->ends_at ? $subscription->ends_at->format('Y-m-d') : '') }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('ends_at') border-red-500 @enderror">
                @error('ends_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">When the subscription ends or renews</p>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-[#003366] mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" 
                        id="status"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="active" {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ old('status', $subscription->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="expired" {{ old('status', $subscription->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="cancelled" {{ old('status', $subscription->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">Current status: <span class="font-medium">{{ ucfirst($subscription->status) }}</span></p>
            </div>

            <!-- Cancelled At (if applicable) -->
            @if($subscription->cancelled_at)
                <div class="bg-red-50 border border-red-200 p-4 rounded-lg">
                    <p class="text-sm font-medium text-red-800">
                        This subscription was cancelled on {{ $subscription->cancelled_at->format('F d, Y') }}
                    </p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.subscriptions.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Subscription
                </button>
            </div>
        </form>
    </div>

    <!-- Subscription History -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Subscription Timeline
        </h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between py-2 border-b border-gray-200">
                <span class="text-sm text-[#4A5568]">Created</span>
                <span class="text-sm font-medium text-[#003366]">{{ $subscription->created_at->format('M d, Y g:i A') }}</span>
            </div>
            @if($subscription->started_at)
                <div class="flex items-center justify-between py-2 border-b border-gray-200">
                    <span class="text-sm text-[#4A5568]">Started</span>
                    <span class="text-sm font-medium text-[#003366]">{{ $subscription->started_at->format('M d, Y') }}</span>
                </div>
            @endif
            @if($subscription->ends_at)
                <div class="flex items-center justify-between py-2 border-b border-gray-200">
                    <span class="text-sm text-[#4A5568]">
                        {{ $subscription->ends_at->isPast() ? 'Ended' : 'Ends' }}
                    </span>
                    <span class="text-sm font-medium text-[#003366]">{{ $subscription->ends_at->format('M d, Y') }}</span>
                </div>
            @endif
            @if($subscription->cancelled_at)
                <div class="flex items-center justify-between py-2 border-b border-gray-200">
                    <span class="text-sm text-[#4A5568]">Cancelled</span>
                    <span class="text-sm font-medium text-red-600">{{ $subscription->cancelled_at->format('M d, Y') }}</span>
                </div>
            @endif
            <div class="flex items-center justify-between py-2">
                <span class="text-sm text-[#4A5568]">Last Updated</span>
                <span class="text-sm font-medium text-[#003366]">{{ $subscription->updated_at->format('M d, Y g:i A') }}</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const planSelect = document.getElementById('plan_id');
    const startDateInput = document.getElementById('started_at');
    const endDateInput = document.getElementById('ends_at');

    // Calculate end date based on billing period
    function calculateEndDate(billingPeriod) {
        const startDate = new Date(startDateInput.value);
        if (!startDate || isNaN(startDate)) return;

        let endDate = new Date(startDate);
        
        switch(billingPeriod) {
            case 'monthly':
                endDate.setMonth(endDate.getMonth() + 1);
                break;
            case 'quarterly':
                endDate.setMonth(endDate.getMonth() + 3);
                break;
            case 'yearly':
                endDate.setFullYear(endDate.getFullYear() + 1);
                break;
            case 'annual':
                endDate.setFullYear(endDate.getFullYear() + 1);
                break;
        }

        // Format date as YYYY-MM-DD
        const year = endDate.getFullYear();
        const month = String(endDate.getMonth() + 1).padStart(2, '0');
        const day = String(endDate.getDate()).padStart(2, '0');
        endDateInput.value = `${year}-${month}-${day}`;
    }

    // Event listeners
    planSelect.addEventListener('change', function() {
        const selectedOption = planSelect.options[planSelect.selectedIndex];
        if (selectedOption.value && startDateInput.value) {
            calculateEndDate(selectedOption.dataset.billingPeriod);
        }
    });

    startDateInput.addEventListener('change', function() {
        const selectedOption = planSelect.options[planSelect.selectedIndex];
        if (selectedOption.value) {
            calculateEndDate(selectedOption.dataset.billingPeriod);
        }
    });
});
</script>
@endpush
@endsection

@extends('layouts.dashboard')

@section('title', 'Create Subscription')
@section('page-title', 'Create Subscription')

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
        <h1 class="text-3xl font-bold text-[#003366]">Create Subscription</h1>
        <p class="text-[#4A5568] mt-1">Add a new subscription for a user</p>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.subscriptions.store') }}" 
              method="POST" 
              class="space-y-6"
              id="subscriptionForm">
            @csrf

            <!-- User Selection -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-[#003366] mb-2">
                    User <span class="text-red-500">*</span>
                </label>
                <select name="user_id" 
                        id="user_id"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('user_id') border-red-500 @enderror">
                    <option value="">Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">Select the user who will receive this subscription</p>
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
                    <option value="">Select a plan</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}" 
                                data-price="{{ $plan->price }}"
                                data-billing-period="{{ $plan->billing_period }}"
                                {{ old('plan_id') == $plan->id ? 'selected' : '' }}>
                            {{ $plan->name }} - ${{ number_format($plan->price, 2) }} / {{ $plan->billing_period }}
                        </option>
                    @endforeach
                </select>
                @error('plan_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">Choose the subscription plan</p>
            </div>

            <!-- Plan Details Preview -->
            <div id="planPreview" class="hidden bg-[#E6F2FF] border border-[#0066CC] p-4 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-[#0066CC] mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="font-medium text-[#003366]">Selected Plan Details</p>
                        <p class="text-sm text-[#4A5568] mt-1" id="planDetails"></p>
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
                       value="{{ old('started_at', now()->format('Y-m-d')) }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('started_at') border-red-500 @enderror">
                @error('started_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">When the subscription begins</p>
            </div>

            <!-- End Date -->
            <div>
                <label for="ends_at" class="block text-sm font-medium text-[#003366] mb-2">
                    End Date <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       name="ends_at" 
                       id="ends_at" 
                       value="{{ old('ends_at') }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('ends_at') border-red-500 @enderror">
                @error('ends_at')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">End date will be auto-calculated based on billing cycle</p>
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
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-[#4A5568]">Set the initial subscription status</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.subscriptions.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Subscription
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const planSelect = document.getElementById('plan_id');
    const startDateInput = document.getElementById('started_at');
    const endDateInput = document.getElementById('ends_at');
    const planPreview = document.getElementById('planPreview');
    const planDetails = document.getElementById('planDetails');

    // Update plan preview and calculate end date
    function updatePlanInfo() {
        const selectedOption = planSelect.options[planSelect.selectedIndex];
        
        if (selectedOption.value) {
            const price = selectedOption.dataset.price;
            const billingPeriod = selectedOption.dataset.billingPeriod;
            
            // Show plan preview
            planPreview.classList.remove('hidden');
            planDetails.textContent = `Price: $${parseFloat(price).toFixed(2)} / ${billingPeriod}. The end date will be calculated based on the billing cycle.`;
            
            // Calculate end date
            calculateEndDate(billingPeriod);
        } else {
            planPreview.classList.add('hidden');
        }
    }

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
    planSelect.addEventListener('change', updatePlanInfo);
    startDateInput.addEventListener('change', function() {
        if (planSelect.value) {
            const selectedOption = planSelect.options[planSelect.selectedIndex];
            calculateEndDate(selectedOption.dataset.billingPeriod);
        }
    });

    // Initial update if plan is already selected
    if (planSelect.value) {
        updatePlanInfo();
    }
});
</script>
@endpush
@endsection

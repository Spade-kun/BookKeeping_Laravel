@extends('layouts.dashboard')

@section('title', 'Edit Plan')
@section('page-title', 'Edit Plan')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ route('admin.plans.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Plans
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Edit Plan: {{ $plan->name }}</h1>
        <p class="text-[#4A5568] mt-1">Update subscription plan details</p>
    </div>

    @if($plan->subscriptions_count > 0)
        <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Warning: Active Subscribers</h3>
                    <p class="mt-1 text-sm text-yellow-700">
                        This plan has {{ $plan->subscriptions_count }} active subscriber{{ $plan->subscriptions_count != 1 ? 's' : '' }}. 
                        Changes to pricing or features will affect existing subscriptions.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8" x-data="planForm()">
        <form action="{{ route('admin.plans.update', $plan) }}" 
              method="POST" 
              class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Plan Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#003366] mb-2">
                    Plan Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $plan->name) }}"
                       required
                       placeholder="e.g., Professional, Basic, Enterprise"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price and Billing Cycle -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-[#003366] mb-2">
                        Price <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" 
                               name="price" 
                               id="price" 
                               value="{{ old('price', $plan->price) }}"
                               step="0.01"
                               min="0"
                               required
                               placeholder="0.00"
                               class="w-full pl-7 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('price') border-red-500 @enderror">
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="billing_cycle" class="block text-sm font-medium text-[#003366] mb-2">
                        Billing Cycle <span class="text-red-500">*</span>
                    </label>
                    <select name="billing_cycle" 
                            id="billing_cycle"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('billing_cycle') border-red-500 @enderror">
                        <option value="">Select cycle</option>
                        <option value="monthly" {{ old('billing_cycle', $plan->billing_cycle) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ old('billing_cycle', $plan->billing_cycle) == 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>
                    @error('billing_cycle')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Features -->
            <div>
                <label class="block text-sm font-medium text-[#003366] mb-2">
                    Plan Features <span class="text-red-500">*</span>
                </label>
                <p class="text-sm text-[#4A5568] mb-3">Add features included in this plan</p>
                
                <div class="space-y-3">
                    <template x-for="(feature, index) in features" :key="index">
                        <div class="flex items-start space-x-2">
                            <input type="text" 
                                   :name="'features[' + index + ']'" 
                                   x-model="features[index]"
                                   placeholder="e.g., Unlimited document uploads"
                                   required
                                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
                            <button type="button" 
                                    @click="removeFeature(index)"
                                    x-show="features.length > 1"
                                    class="px-3 py-3 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>

                <button type="button" 
                        @click="addFeature"
                        class="mt-3 inline-flex items-center px-4 py-2 border border-[#0066CC] text-[#0066CC] rounded-lg hover:bg-[#E6F2FF] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Feature
                </button>
                
                @error('features')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('features.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Is Active -->
            <div class="flex items-center">
                <input type="checkbox" 
                       name="is_active" 
                       id="is_active" 
                       value="1"
                       {{ old('is_active', $plan->is_active) ? 'checked' : '' }}
                       class="w-5 h-5 text-[#0066CC] border-gray-300 rounded focus:ring-2 focus:ring-[#0066CC]">
                <label for="is_active" class="ml-3 text-sm font-medium text-[#003366]">
                    Active (Users can subscribe to this plan)
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.plans.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
                    Update Plan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function planForm() {
    return {
        features: @json(old('features', $plan->features)),
        addFeature() {
            this.features.push('');
        },
        removeFeature(index) {
            if (this.features.length > 1) {
                this.features.splice(index, 1);
            }
        }
    }
}
</script>
@endsection

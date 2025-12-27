@extends('layouts.dashboard')

@section('title', 'Subscription Plans')
@section('page-title', 'Choose Your Plan')

@section('sidebar')
    @include('partials.user-sidebar')
@endsection

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="text-center">
        <h1 class="text-4xl font-bold text-[#003366]">Choose the Perfect Plan</h1>
        <p class="text-[#4A5568] mt-3 text-lg">Start your bookkeeping journey with the plan that fits your needs</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    @if(auth()->user()->activeSubscription)
        <div class="bg-blue-50 border-l-4 border-[#0066CC] p-4 rounded-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-[#003366]">Current Plan: {{ auth()->user()->activeSubscription->plan->name }}</p>
                    <p class="text-sm text-[#4A5568] mt-1">
                        {{ auth()->user()->activeSubscription->plan->billing_period == 'monthly' ? 'Monthly' : 'Yearly' }} billing 
                        @if(auth()->user()->activeSubscription->ends_at)
                            - Expires {{ \Carbon\Carbon::parse(auth()->user()->activeSubscription->ends_at)->format('M d, Y') }}
                        @endif
                    </p>
                </div>
                <form action="{{ route('subscriptions.cancel') }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel your subscription?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm text-red-600 hover:text-red-800 border border-red-300 rounded-lg hover:bg-red-50 transition-colors">
                        Cancel Subscription
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Plans Grid -->
    <div class="grid md:grid-cols-3 gap-8 max-w-7xl mx-auto">
        @foreach($plans as $plan)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all hover:scale-105 hover:shadow-2xl {{ $plan->name == 'Professional' ? 'ring-4 ring-[#0066CC]' : '' }}">
                @if($plan->name == 'Professional')
                    <div class="bg-[#0066CC] text-white text-center py-2 text-sm font-medium">
                        MOST POPULAR
                    </div>
                @endif
                
                <div class="p-8">
                    <!-- Plan Header -->
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-[#003366] mb-2">{{ $plan->name }}</h3>
                        <div class="flex items-baseline justify-center">
                            <span class="text-4xl font-extrabold text-[#0066CC]">${{ number_format($plan->price, 2) }}</span>
                            <span class="text-[#4A5568] ml-2">/{{ $plan->billing_period == 'monthly' ? 'month' : 'year' }}</span>
                        </div>
                        @if($plan->billing_period == 'yearly')
                            <p class="text-sm text-green-600 mt-2">Save {{ number_format((1 - ($plan->price / 12) / ($plan->price / 12)) * 100) }}% vs monthly</p>
                        @endif
                    </div>

                    <!-- Features List -->
                    <ul class="space-y-3 mb-8">
                        @foreach($plan->features as $feature)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-[#4A5568]">{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Subscribe Button -->
                    @if(auth()->user()->activeSubscription && auth()->user()->activeSubscription->plan_id == $plan->id)
                        <button disabled class="w-full py-3 px-6 bg-gray-300 text-gray-600 rounded-lg font-medium cursor-not-allowed">
                            Current Plan
                        </button>
                    @else
                        <form action="{{ route('subscriptions.subscribe', $plan) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="w-full py-3 px-6 {{ $plan->name == 'Professional' ? 'bg-[#0066CC] hover:bg-[#003366]' : 'bg-[#003366] hover:bg-[#002147]' }} text-white rounded-lg font-medium transition-colors">
                                {{ auth()->user()->activeSubscription ? 'Switch to ' . $plan->name : 'Get Started' }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- FAQ Section -->
    <div class="max-w-3xl mx-auto mt-16">
        <h2 class="text-2xl font-bold text-[#003366] text-center mb-8">Frequently Asked Questions</h2>
        <div class="bg-white rounded-xl shadow-md p-8 space-y-6">
            <div>
                <h3 class="font-semibold text-[#003366] mb-2">Can I change my plan later?</h3>
                <p class="text-[#4A5568]">Yes, you can upgrade or downgrade your plan at any time. Changes take effect immediately.</p>
            </div>
            <div>
                <h3 class="font-semibold text-[#003366] mb-2">What payment methods do you accept?</h3>
                <p class="text-[#4A5568]">We accept all major credit cards, debit cards, and PayPal.</p>
            </div>
            <div>
                <h3 class="font-semibold text-[#003366] mb-2">Can I cancel my subscription?</h3>
                <p class="text-[#4A5568]">Yes, you can cancel your subscription at any time. You'll retain access until the end of your billing period.</p>
            </div>
        </div>
    </div>
</div>
@endsection

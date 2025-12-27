@extends('layouts.dashboard')

@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('sidebar')
    @if(auth()->user()->isAdmin())
        @include('partials.admin-sidebar')
    @elseif(auth()->user()->isTeam())
        @include('partials.team-sidebar')
    @else
        @include('partials.user-sidebar')
    @endif
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">My Profile</h1>
            <p class="text-[#4A5568] mt-1">Manage your account information</p>
        </div>
        <a href="{{ route('profile.edit') }}" 
           class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
            <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
           <p class="text-white">Edit Profile</p> 
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Profile Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-[#0066CC] to-[#003366] px-8 py-12">
            <div class="flex items-center space-x-6">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" 
                         alt="{{ auth()->user()->name }}"
                         class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                @else
                    <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-white flex items-center justify-center">
                        <span class="text-3xl font-bold text-[#0066CC]">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                @endif
                <div>
                    <h2 class="text-3xl font-bold text-white">{{ auth()->user()->name }}</h2>
                    <p class="text-blue-100 mt-1">{{ auth()->user()->email }}</p>
                    <div class="mt-2">
                        <span class="inline-flex px-3 py-1 text-sm font-medium rounded-full bg-white/20 text-white">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Sections -->
        <div class="p-8 space-y-8">
            <!-- Account Information -->
            <div>
                <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Account Information
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Full Name</p>
                        <p class="font-medium text-[#003366]">{{ auth()->user()->name }}</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Email Address</p>
                        <p class="font-medium text-[#003366]">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Account Type</p>
                        <p class="font-medium text-[#003366]">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg">
                        <p class="text-sm text-[#4A5568] mb-1">Member Since</p>
                        <p class="font-medium text-[#003366]">{{ auth()->user()->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Subscription Information (Users Only) -->
            @if(auth()->user()->isUser())
                <div>
                    <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Subscription
                    </h3>
                    @if(auth()->user()->activeSubscription)
                        <div class="bg-[#E6F2FF] border border-[#0066CC] p-6 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <p class="text-2xl font-bold text-[#003366]">{{ auth()->user()->activeSubscription->plan->name }}</p>
                                    <p class="text-[#4A5568] mt-1">
                                        ${{ number_format(auth()->user()->activeSubscription->plan->price, 2) }} / 
                                        {{ auth()->user()->activeSubscription->plan->billing_period }}
                                    </p>
                                </div>
                                <span class="inline-flex px-4 py-2 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            </div>
                            <div class="grid md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm text-[#4A5568]">Start Date</p>
                                    <p class="font-medium text-[#003366]">
                                        @if(auth()->user()->activeSubscription->started_at)
                                            {{ \Carbon\Carbon::parse(auth()->user()->activeSubscription->started_at)->format('M d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-[#4A5568]">Renewal Date</p>
                                    <p class="font-medium text-[#003366]">
                                        @if(auth()->user()->activeSubscription->ends_at)
                                            {{ \Carbon\Carbon::parse(auth()->user()->activeSubscription->ends_at)->format('M d, Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('subscriptions.index') }}" 
                               class="inline-flex items-center text-[#0066CC] hover:text-[#003366] font-medium">
                                Manage Subscription
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg text-center">
                            <p class="text-[#4A5568] mb-4">You don't have an active subscription</p>
                            <a href="{{ route('subscriptions.index') }}" 
                               class="inline-flex items-center bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                View Plans
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Authentication Information -->
            @if(auth()->user()->google_id)
                <div>
                    <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Connected Accounts
                    </h3>
                    <div class="bg-[#F7FAFC] p-4 rounded-lg flex items-center">
                        <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-[#003366]">Google Account</p>
                            <p class="text-sm text-[#4A5568]">Connected via Google OAuth</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Sign In - Everly BookKeeping')
@section('description', 'Sign in to your Everly BookKeeping account with Google to access your personalized dashboard and manage your bookkeeping documents.')
@section('og_image', asset('images/EverlyLogo.jpeg'))

@push('styles')
<meta name="robots" content="noindex, nofollow">
<link rel="canonical" href="{{ route('login') }}">
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#F7FAFC] to-[#E6F2FF] flex items-center justify-center px-4 py-32">
    <div class="max-w-md w-full">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12">
            <!-- Logo -->
            <div class="text-center mb-8">
                <img src="{{ asset('images/EverlyBookLogo.jpeg') }}" 
                     alt="Everly Bookkeeping" 
                     class="w-28 h-28 rounded-full mx-auto object-cover mb-4 shadow-lg border-4 border-[#0066CC]">
                <h1 class="text-3xl md:text-4xl font-bold text-[#003366] mb-2">
                    Welcome Back
                </h1>
                <p class="text-[#4A5568] text-lg">
                    Sign in to access your dashboard
                </p>
            </div>

            <!-- Google Sign In Button -->
            <a href="{{ route('auth.google') }}" 
               class="group relative inline-flex items-center justify-center w-full bg-white border-2 border-[#E2E8F0] hover:border-[#0066CC] hover:shadow-xl text-[#003366] font-medium px-6 py-4 rounded-full transition-all duration-300 shadow-md overflow-hidden">
                <!-- Hover Effect -->
                <span class="absolute inset-0 bg-gradient-to-r from-[#E6F2FF] to-[#F0F7FF] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300 rounded-full"></span>
                
                <!-- Google Icon -->
                <svg class="relative w-6 h-6 mr-3 flex-shrink-0" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                
                <!-- Text -->
                <span class="relative text-base md:text-lg">Sign in with Google</span>
            </a>

            <!-- Benefits -->
            <div class="mt-8 space-y-3">
                <div class="flex items-center text-sm text-[#4A5568]">
                    <svg class="w-5 h-5 text-[#0066CC] mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Access your personalized dashboard</span>
                </div>
                <div class="flex items-center text-sm text-[#4A5568]">
                    <svg class="w-5 h-5 text-[#0066CC] mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Manage your bookkeeping documents</span>
                </div>
                <div class="flex items-center text-sm text-[#4A5568]">
                    <svg class="w-5 h-5 text-[#0066CC] mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Track your financial reports</span>
                </div>
            </div>

            <!-- Privacy Note -->
            <p class="text-xs text-[#718096] mt-8 text-center">
                By signing in, you agree to our 
                <a href="#" class="text-[#0066CC] hover:underline">Terms of Service</a> and 
                <a href="#" class="text-[#0066CC] hover:underline">Privacy Policy</a>.
            </p>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-[#0066CC] hover:text-[#0055B8] font-medium inline-flex items-center transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</div>
@endsection

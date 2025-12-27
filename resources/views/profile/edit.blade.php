@extends('layouts.dashboard')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('sidebar')
    @if(auth()->user()->isAdmin())
        @include('partials.admin-sidebar')
    @else
        @include('partials.user-sidebar')
    @endif
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ route('profile.show') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Profile
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Edit Profile</h1>
        <p class="text-[#4A5568] mt-1">Update your account information and password</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Profile Picture Section -->
            @if(auth()->user()->google_avatar)
                <div class="flex items-center space-x-4">
                    <img src="{{ auth()->user()->google_avatar }}" 
                         alt="{{ auth()->user()->name }}"
                         class="w-20 h-20 rounded-full border-2 border-gray-200">
                    <div>
                        <p class="font-medium text-[#003366]">Profile Picture</p>
                        <p class="text-sm text-[#4A5568]">Synced from your Google account</p>
                    </div>
                </div>
                <div class="border-t border-gray-200 my-6"></div>
            @endif

            <!-- Account Information -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-[#003366]">Account Information</h3>
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#003366] mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', auth()->user()->name) }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#003366] mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', auth()->user()->email) }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-gray-200 my-6"></div>

            <!-- Change Password Section -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-[#003366]">
                        @if(!auth()->user()->hasPassword())
                            Set Password
                        @else
                            Change Password
                        @endif
                    </h3>
                    @if(!auth()->user()->hasPassword())
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-2">
                            <div class="flex">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Please add a password to your account</p>
                                    <p class="text-sm text-blue-700 mt-1">You signed in using Google. Add a password to enable traditional login as well.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-[#4A5568] mt-1">Leave blank if you don't want to change your password</p>
                    @endif
                </div>

                @if(auth()->user()->hasPassword())
                    <!-- Current Password (only shown if user already has a password) -->
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-[#003366] mb-2">
                            Current Password
                        </label>
                        <input type="password" 
                               name="current_password" 
                               id="current_password" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('current_password') border-red-500 @enderror">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#003366] mb-2">
                        @if(!auth()->user()->hasPassword())
                            Password <span class="text-red-500">*</span>
                        @else
                            New Password
                        @endif
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-[#4A5568] mt-1">Must be at least 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#003366] mb-2">
                        @if(!auth()->user()->hasPassword())
                            Confirm Password <span class="text-red-500">*</span>
                        @else
                            Confirm New Password
                        @endif
                    </label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('profile.show') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-red-50 border border-red-200 rounded-xl p-8">
        <h3 class="text-lg font-semibold text-red-900 mb-2">Danger Zone</h3>
        <p class="text-sm text-red-700 mb-4">Once you delete your account, there is no going back. Please be certain.</p>
        <button onclick="alert('Account deletion feature coming soon!')" 
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition-colors">
            Delete Account
        </button>
    </div>
</div>
@endsection

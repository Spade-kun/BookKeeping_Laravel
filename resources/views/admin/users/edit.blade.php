@extends('layouts.dashboard')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ route('admin.users.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Users
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Edit User</h1>
        <p class="text-[#4A5568] mt-1">Update user information and permissions</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Profile Picture (if available) -->
            @if($user->google_avatar)
                <div class="flex items-center space-x-4 pb-6 border-b border-gray-200">
                    <img src="{{ $user->google_avatar }}" 
                         alt="{{ $user->name }}"
                         class="w-16 h-16 rounded-full border-2 border-gray-200">
                    <div>
                        <p class="font-medium text-[#003366]">{{ $user->name }}</p>
                        <p class="text-sm text-[#4A5568]">{{ $user->email }}</p>
                    </div>
                </div>
            @endif

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-[#003366] mb-2">
                    Full Name <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $user->name) }}"
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
                       value="{{ old('email', $user->email) }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-[#003366] mb-2">
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="role" 
                        id="role"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('role') border-red-500 @enderror">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    <option value="team" {{ $user->role == 'team' ? 'selected' : '' }}>Team</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="text-sm text-[#4A5568] mt-1">
                    <strong>User:</strong> Can upload documents and message team<br>
                    <strong>Team:</strong> Can view assigned users and respond to messages<br>
                    <strong>Admin:</strong> Full access to manage users, teams, plans, and all data
                </p>
            </div>

            <div class="border-t border-gray-200 my-6"></div>

            <!-- Password Section -->
            <div class="bg-[#F7FAFC] p-6 rounded-lg space-y-4">
                <div>
                    <h3 class="text-lg font-semibold text-[#003366]">Change Password</h3>
                    <p class="text-sm text-[#4A5568] mt-1">Leave blank to keep current password</p>
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#003366] mb-2">
                        New Password
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="text-sm text-[#4A5568] mt-1">Minimum 8 characters</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-[#003366] mb-2">
                        Confirm New Password
                    </label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
                    Update User
                </button>
            </div>
        </form>
    </div>

    <!-- Subscription Management -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-lg font-semibold text-[#003366] mb-4">Subscription Management</h3>
        @if($user->activeSubscription)
            <div class="bg-[#E6F2FF] border border-[#0066CC] p-6 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xl font-bold text-[#003366]">{{ $user->activeSubscription->plan->name }}</p>
                        <p class="text-[#4A5568] mt-1">
                            Expires: {{ $user->activeSubscription->end_date->format('M d, Y') }}
                        </p>
                    </div>
                    <a href="{{ route('admin.subscriptions.index', ['user' => $user->id]) }}" 
                       class="text-[#0066CC] hover:text-[#003366] font-medium">
                        Manage Subscription →
                    </a>
                </div>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg text-center">
                <p class="text-[#4A5568] mb-4">This user doesn't have an active subscription</p>
                <a href="{{ route('admin.subscriptions.create', ['user_id' => $user->id]) }}" 
                   class="inline-flex items-center bg-[#0066CC] hover:bg-[#003366] text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Create Subscription
                </a>
            </div>
        @endif
    </div>

    <!-- User Statistics -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <h3 class="text-lg font-semibold text-[#003366] mb-6">User Statistics</h3>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Total Documents</p>
                <p class="text-2xl font-bold text-[#003366]">{{ $user->documents()->count() }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Total Reports</p>
                <p class="text-2xl font-bold text-[#003366]">{{ $user->reports()->count() }}</p>
            </div>
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm text-[#4A5568] mb-1">Member Since</p>
                <p class="text-lg font-bold text-[#003366]">{{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

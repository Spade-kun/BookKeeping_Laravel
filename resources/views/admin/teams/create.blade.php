@extends('layouts.dashboard')

@section('title', 'Create Team')
@section('page-title', 'Create Team')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-[#003366]">Create New Team</h1>
            <p class="text-[#4A5568] mt-1">Set up a new team and assign members</p>
        </div>
        <a href="{{ route('admin.teams.index') }}" class="text-[#0066CC] hover:text-[#003366] flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Teams
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
    @endif

    <form action="{{ route('admin.teams.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Team Information -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#003366] mb-4">Team Information</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-[#003366] mb-2">Team Name *</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('name') border-red-500 @enderror"
                           placeholder="e.g., Team 1, Tax Team, Payroll Team">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-[#003366] mb-2">Description</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Describe the team's purpose or specialization...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Team Leads -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#003366] mb-4">Team Leads</h2>
            <p class="text-sm text-[#4A5568] mb-4">Select users who will lead this team</p>
            
            <div class="grid md:grid-cols-2 gap-4">
                @forelse($availableUsers->where('role', 'team') as $user)
                    <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox" name="leads[]" value="{{ $user->id }}" class="mr-3 h-4 w-4 text-[#0066CC] focus:ring-[#0066CC] border-gray-300 rounded">
                        <div class="flex items-center">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full mr-2">
                            @else
                                <div class="w-8 h-8 rounded-full bg-[#E6F2FF] flex items-center justify-center mr-2">
                                    <span class="text-[#0066CC] font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-[#003366]">{{ $user->name }}</p>
                                <p class="text-xs text-[#4A5568]">{{ $user->email }}</p>
                            </div>
                        </div>
                    </label>
                @empty
                    <p class="col-span-2 text-gray-500 text-center py-4">No available team staff to assign as leads</p>
                @endforelse
            </div>
        </div>

        <!-- Team Members -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-[#003366] mb-4">Team Members</h2>
            <p class="text-sm text-[#4A5568] mb-4">Select team staff and users to assign to this team</p>
            
            <div class="grid md:grid-cols-2 gap-4">
                @forelse($availableUsers as $user)
                    <label class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                        <input type="checkbox" name="members[]" value="{{ $user->id }}" class="mr-3 h-4 w-4 text-[#0066CC] focus:ring-[#0066CC] border-gray-300 rounded">
                        <div class="flex items-center">
                            @if($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-8 h-8 rounded-full mr-2">
                            @else
                                <div class="w-8 h-8 rounded-full bg-[#E6F2FF] flex items-center justify-center mr-2">
                                    <span class="text-[#0066CC] font-semibold text-sm">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm font-medium text-[#003366]">{{ $user->name }}</p>
                                <p class="text-xs text-[#4A5568]">{{ $user->email }} 
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </label>
                @empty
                    <p class="col-span-2 text-gray-500 text-center py-4">No available users to assign</p>
                @endforelse
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('admin.teams.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-[#0066CC] text-white px-6 py-2 rounded-lg hover:bg-[#003366] transition-colors">
                    Create Team
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

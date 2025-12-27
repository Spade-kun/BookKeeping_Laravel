@extends('layouts.dashboard')

@section('title', 'Create Report')
@section('page-title', 'Create Report')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ route('admin.reports.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Reports
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Create Financial Report</h1>
        <p class="text-[#4A5568] mt-1">Generate a new bookkeeping report</p>
    </div>

    <!-- Create Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.reports.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
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
            </div>

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-[#003366] mb-2">
                    Report Title <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       value="{{ old('title') }}"
                       required
                       placeholder="e.g., Q4 2023 Financial Summary"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Report Type -->
            <div>
                <label for="report_type" class="block text-sm font-medium text-[#003366] mb-2">
                    Report Type <span class="text-red-500">*</span>
                </label>
                <select name="report_type" 
                        id="report_type"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('report_type') border-red-500 @enderror">
                    <option value="">Select type</option>
                    <option value="monthly" {{ old('report_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="quarterly" {{ old('report_type') == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                    <option value="annual" {{ old('report_type') == 'annual' ? 'selected' : '' }}>Annual</option>
                    <option value="custom" {{ old('report_type') == 'custom' ? 'selected' : '' }}>Custom</option>
                </select>
                @error('report_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Period -->
            <div>
                <label for="period" class="block text-sm font-medium text-[#003366] mb-2">
                    Period <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="period" 
                       id="period" 
                       value="{{ old('period') }}"
                       required
                       placeholder="e.g., Q4 2023, January 2024"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('period') border-red-500 @enderror">
                @error('period')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Range -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-[#003366] mb-2">
                        Start Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="start_date" 
                           id="start_date" 
                           value="{{ old('start_date') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('start_date') border-red-500 @enderror">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-[#003366] mb-2">
                        End Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="end_date" 
                           id="end_date" 
                           value="{{ old('end_date') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('end_date') border-red-500 @enderror">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- File Upload -->
            <div>
                <label for="file" class="block text-sm font-medium text-[#003366] mb-2">
                    Report File
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-[#0066CC] transition-colors @error('file') border-red-500 @enderror">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0066CC] hover:text-[#003366]">
                                <span>Upload a file</span>
                                <input id="file" 
                                       name="file" 
                                       type="file" 
                                       class="sr-only"
                                       accept=".pdf,.xlsx,.xls,.csv"
                                       onchange="displayFileName(this)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PDF, XLSX, XLS, CSV up to 10MB
                        </p>
                        <p id="file-name" class="text-sm font-medium text-[#0066CC] mt-2"></p>
                    </div>
                </div>
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-[#003366] mb-2">
                    Description
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          placeholder="Optional notes or summary about this report"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ route('admin.reports.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
                    Create Report
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function displayFileName(input) {
    const fileNameDisplay = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        fileNameDisplay.textContent = 'Selected: ' + input.files[0].name;
    }
}
</script>
@endsection

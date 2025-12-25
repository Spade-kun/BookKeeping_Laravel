@extends('layouts.dashboard')

@section('title', 'Upload Document')
@section('page-title', 'Upload Document')

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
        <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.index') : route('documents.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Documents
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Upload New Document</h1>
        <p class="text-[#4A5568] mt-1">Upload receipts, invoices, or other bookkeeping documents</p>
    </div>

    <!-- Upload Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ auth()->user()->isAdmin() ? route('admin.documents.store') : route('documents.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf

            @if(auth()->user()->isAdmin())
                <!-- User Selection (Admin Only) -->
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
            @endif

            <!-- File Upload -->
            <div>
                <label for="file" class="block text-sm font-medium text-[#003366] mb-2">
                    Document File <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-[#0066CC] transition-colors @error('file') border-red-500 @enderror">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0066CC] hover:text-[#003366] focus-within:outline-none">
                                <span>Upload a file</span>
                                <input id="file" 
                                       name="file" 
                                       type="file" 
                                       class="sr-only" 
                                       required
                                       accept=".pdf,.jpg,.jpeg,.png,.xlsx,.xls,.csv,.doc,.docx"
                                       onchange="displayFileName(this)">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PDF, JPG, PNG, XLSX, XLS, CSV, DOC, DOCX up to 10MB
                        </p>
                        <p id="file-name" class="text-sm font-medium text-[#0066CC] mt-2"></p>
                    </div>
                </div>
                @error('file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Year Selection -->
            <div>
                <label for="year" class="block text-sm font-medium text-[#003366] mb-2">
                    Year <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       name="year" 
                       id="year" 
                       required
                       min="1900"
                       max="{{ date('Y') + 10 }}"
                       value="{{ old('year', date('Y')) }}"
                       placeholder="e.g., {{ date('Y') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('year') border-red-500 @enderror">
                <p class="mt-1 text-xs text-[#4A5568]">Enter the year of the document (1900 - {{ date('Y') + 10 }})</p>
                @error('year')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type Selection -->
            <div>
                <label for="type" class="block text-sm font-medium text-[#003366] mb-2">
                    Document Type <span class="text-red-500">*</span>
                </label>
                <select name="type" 
                        id="type" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('type') border-red-500 @enderror">
                    <option value="">Select Type</option>
                    <option value="Receipts" {{ old('type') == 'Receipts' ? 'selected' : '' }}>Receipts</option>
                    <option value="Invoices" {{ old('type') == 'Invoices' ? 'selected' : '' }}>Invoices</option>
                    <option value="Bank Statements" {{ old('type') == 'Bank Statements' ? 'selected' : '' }}>Bank Statements</option>
                    <option value="Payroll" {{ old('type') == 'Payroll' ? 'selected' : '' }}>Payroll</option>
                    <option value="Reports" {{ old('type') == 'Reports' ? 'selected' : '' }}>Reports</option>
                    <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-[#003366] mb-2">
                    Description (Optional)
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          placeholder="Add notes about this document..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4">
                <a href="{{ auth()->user()->isAdmin() ? route('admin.documents.index') : route('documents.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload Document
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

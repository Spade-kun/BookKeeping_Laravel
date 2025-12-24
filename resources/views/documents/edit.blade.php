@extends('layouts.dashboard')

@section('title', 'Edit Document')
@section('page-title', 'Edit Document')

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
        <h1 class="text-3xl font-bold text-[#003366]">Edit Document</h1>
        <p class="text-[#4A5568] mt-1">Update document information or replace file</p>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ auth()->user()->isAdmin() ? route('admin.documents.update', $document) : route('documents.update', $document) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')

            @if(auth()->user()->isAdmin())
                <!-- User Selection (Admin Only) -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-[#003366] mb-2">
                        User
                    </label>
                    <select name="user_id" 
                            id="user_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('user_id') border-red-500 @enderror">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $document->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Current File Info -->
            <div class="bg-[#F7FAFC] p-4 rounded-lg">
                <p class="text-sm font-medium text-[#003366] mb-2">Current File</p>
                <p class="text-[#4A5568]">{{ $document->file_name }}</p>
                <p class="text-sm text-[#4A5568]">{{ number_format($document->file_size / 1024, 2) }} KB</p>
            </div>

            <!-- Replace File (Optional) -->
            <div>
                <label for="file" class="block text-sm font-medium text-[#003366] mb-2">
                    Replace File (Optional)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-[#0066CC] transition-colors @error('file') border-red-500 @enderror">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-[#0066CC] hover:text-[#003366]">
                                <span>Upload a new file</span>
                                <input id="file" 
                                       name="file" 
                                       type="file" 
                                       class="sr-only"
                                       accept=".pdf,.jpg,.jpeg,.png,.xlsx,.xls,.csv,.doc,.docx">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                            PDF, JPG, PNG, XLSX, XLS, CSV, DOC, DOCX up to 10MB
                        </p>
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
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $document->description) }}</textarea>
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
                        class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors">
                    Update Document
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

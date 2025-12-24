@extends('layouts.dashboard')

@section('title', 'Edit Transaction')
@section('page-title', 'Edit Transaction')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header -->
    <div>
        <a href="{{ route('admin.transactions.index') }}" 
           class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Transactions
        </a>
        <h1 class="text-3xl font-bold text-[#003366]">Edit Transaction</h1>
        <p class="text-[#4A5568] mt-1">Update transaction details</p>
    </div>

    <!-- Edit Form -->
    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.transactions.update', $transaction) }}" 
              method="POST" 
              class="space-y-6">
            @csrf
            @method('PUT')

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
                        <option value="{{ $user->id }}" {{ (old('user_id', $transaction->user_id) == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Transaction Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-[#003366] mb-2">
                    Transaction Type <span class="text-red-500">*</span>
                </label>
                <select name="type" 
                        id="type"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('type') border-red-500 @enderror">
                    <option value="">Select type</option>
                    <option value="income" {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }}>Income</option>
                    <option value="expense" {{ old('type', $transaction->type) == 'expense' ? 'selected' : '' }}>Expense</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-sm font-medium text-[#003366] mb-2">
                    Amount <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">$</span>
                    </div>
                    <input type="number" 
                           name="amount" 
                           id="amount" 
                           value="{{ old('amount', $transaction->amount) }}"
                           required
                           step="0.01"
                           min="0"
                           placeholder="0.00"
                           class="w-full pl-7 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('amount') border-red-500 @enderror">
                </div>
                @error('amount')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-[#003366] mb-2">
                    Category
                </label>
                <input type="text" 
                       name="category" 
                       id="category" 
                       value="{{ old('category', $transaction->category) }}"
                       placeholder="e.g., Office Supplies, Client Payment"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('category') border-red-500 @enderror">
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Transaction Date -->
            <div>
                <label for="date" class="block text-sm font-medium text-[#003366] mb-2">
                    Transaction Date <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       name="date" 
                       id="date" 
                       value="{{ old('date', $transaction->date->format('Y-m-d')) }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('date') border-red-500 @enderror">
                @error('date')
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
                          placeholder="Enter transaction description or notes..."
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $transaction->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Reference Number -->
            <div>
                <label for="reference_number" class="block text-sm font-medium text-[#003366] mb-2">
                    Reference Number
                </label>
                <input type="text" 
                       name="reference_number" 
                       id="reference_number" 
                       value="{{ old('reference_number', $transaction->reference_number) }}"
                       placeholder="e.g., INV-001, REF-12345"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('reference_number') border-red-500 @enderror">
                @error('reference_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-[#003366] mb-2">
                    Notes
                </label>
                <textarea name="notes" 
                          id="notes" 
                          rows="3"
                          placeholder="Additional notes (internal use only)"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes', $transaction->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <form action="{{ route('admin.transactions.destroy', $transaction) }}" 
                      method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this transaction? This action cannot be undone.');"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Transaction
                    </button>
                </form>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.transactions.index') }}" 
                       class="px-6 py-3 border border-gray-300 rounded-lg text-[#4A5568] hover:bg-gray-50 font-medium transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Transaction
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

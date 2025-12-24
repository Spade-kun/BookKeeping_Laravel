@extends('layouts.dashboard')

@section('title', 'Transaction Details')
@section('page-title', 'Transaction Details')

@section('sidebar')
    @include('partials.admin-sidebar')
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.transactions.index') }}" 
               class="inline-flex items-center text-[#0066CC] hover:text-[#003366] mb-4">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Transactions
            </a>
            <h1 class="text-3xl font-bold text-[#003366]">Transaction Details</h1>
            <p class="text-[#4A5568] mt-1">View complete transaction information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.transactions.edit', $transaction) }}" 
               class="bg-[#0066CC] hover:bg-[#003366] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <!-- Transaction Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Transaction Type & Amount Header -->
        <div class="bg-gradient-to-r {{ $transaction->type === 'income' ? 'from-green-50 to-green-100' : 'from-red-50 to-red-100' }} px-8 py-6 border-b {{ $transaction->type === 'income' ? 'border-green-200' : 'border-red-200' }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    @if($transaction->type === 'income')
                        <div class="bg-green-500 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                        </div>
                    @else
                        <div class="bg-red-500 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium {{ $transaction->type === 'income' ? 'text-green-700' : 'text-red-700' }}">
                            {{ ucfirst($transaction->type) }}
                        </p>
                        <p class="text-3xl font-bold {{ $transaction->type === 'income' ? 'text-green-900' : 'text-red-900' }}">
                            {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                        </p>
                    </div>
                </div>
                <span class="inline-flex px-4 py-2 text-sm font-semibold rounded-full {{ $transaction->type === 'income' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                    {{ ucfirst($transaction->type) }}
                </span>
            </div>
        </div>

        <!-- Transaction Details -->
        <div class="px-8 py-6 space-y-6">
            <!-- User Information -->
            <div>
                <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    User Information
                </h3>
                <div class="bg-[#F7FAFC] rounded-lg p-4">
                    <div class="flex items-center space-x-4">
                        <div class="bg-[#E6F2FF] p-3 rounded-full">
                            <svg class="w-6 h-6 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-[#003366]">{{ $transaction->user->name }}</p>
                            <p class="text-sm text-[#4A5568]">{{ $transaction->user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Details Grid -->
            <div>
                <h3 class="text-lg font-semibold text-[#003366] mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Transaction Details
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-[#F7FAFC] rounded-lg p-4">
                        <p class="text-sm text-[#4A5568] mb-1">Transaction Date</p>
                        <p class="font-semibold text-[#003366]">{{ $transaction->date->format('F d, Y') }}</p>
                        <p class="text-xs text-[#4A5568] mt-1">{{ $transaction->date->diffForHumans() }}</p>
                    </div>

                    <div class="bg-[#F7FAFC] rounded-lg p-4">
                        <p class="text-sm text-[#4A5568] mb-1">Amount</p>
                        <p class="font-semibold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }} text-xl">
                            {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                        </p>
                    </div>

                    @if($transaction->category)
                        <div class="bg-[#F7FAFC] rounded-lg p-4">
                            <p class="text-sm text-[#4A5568] mb-1">Category</p>
                            <p class="font-semibold text-[#003366]">{{ $transaction->category }}</p>
                        </div>
                    @endif

                    @if($transaction->reference_number)
                        <div class="bg-[#F7FAFC] rounded-lg p-4">
                            <p class="text-sm text-[#4A5568] mb-1">Reference Number</p>
                            <p class="font-semibold text-[#003366]">{{ $transaction->reference_number }}</p>
                        </div>
                    @endif

                    <div class="bg-[#F7FAFC] rounded-lg p-4">
                        <p class="text-sm text-[#4A5568] mb-1">Created At</p>
                        <p class="font-semibold text-[#003366]">{{ $transaction->created_at->format('M d, Y g:i A') }}</p>
                    </div>

                    <div class="bg-[#F7FAFC] rounded-lg p-4">
                        <p class="text-sm text-[#4A5568] mb-1">Last Updated</p>
                        <p class="font-semibold text-[#003366]">{{ $transaction->updated_at->format('M d, Y g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            @if($transaction->description)
                <div>
                    <h3 class="text-lg font-semibold text-[#003366] mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        Description
                    </h3>
                    <div class="bg-[#F7FAFC] rounded-lg p-4">
                        <p class="text-[#003366] whitespace-pre-wrap">{{ $transaction->description }}</p>
                    </div>
                </div>
            @endif

            <!-- Notes -->
            @if($transaction->notes)
                <div>
                    <h3 class="text-lg font-semibold text-[#003366] mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                        Internal Notes
                    </h3>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg p-4">
                        <p class="text-[#003366] whitespace-pre-wrap">{{ $transaction->notes }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Footer Actions -->
        <div class="bg-[#F7FAFC] px-8 py-4 border-t border-gray-200 flex items-center justify-between">
            <form action="{{ route('admin.transactions.destroy', $transaction) }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this transaction? This action cannot be undone.');"
                  class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Delete Transaction
                </button>
            </form>

            <a href="{{ route('admin.transactions.edit', $transaction) }}" 
               class="px-6 py-2 bg-[#0066CC] hover:bg-[#003366] text-white rounded-lg font-medium transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit Transaction
            </a>
        </div>
    </div>
</div>
@endsection

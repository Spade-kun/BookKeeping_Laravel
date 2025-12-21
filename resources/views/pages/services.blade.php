@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<!-- Hero Section -->
<x-hero 
    title="Comprehensive Bookkeeping Services"
    subtitle="Everything you need to keep your finances organized and compliant"
    backgroundImage="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1920&q=80"
    height="min-h-[70vh]">
    <x-slot:cta>
        <x-button href="{{ route('contact') }}" variant="primary" size="lg">
            Schedule Consultation
        </x-button>
    </x-slot:cta>
</x-hero>

<!-- What We Do Section -->
<x-section 
    title="What We Do"
    subtitle="Full-service bookkeeping tailored to your business">
    <div class="prose prose-lg max-w-3xl mx-auto text-center mb-12">
        <p class="text-xl text-[#4A5568]">
            We handle all aspects of your financial record-keeping, from daily transactions to monthly reports, 
            ensuring your books are always accurate, up-to-date, and ready for decision-making.
        </p>
    </div>
</x-section>

<!-- What's Included Section -->
<x-section 
    title="What's Included"
    background="bg-[#F7FAFC]">
    <div class="grid md:grid-cols-2 gap-6 max-w-5xl mx-auto stagger-container">
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2 text-[#003366]">Transaction Recording</h3>
                <p class="text-[#4A5568]">Accurate recording of all business transactions in real-time.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Account Reconciliation</h3>
                <p class="text-[#4A5568]">Monthly bank and credit card reconciliation to ensure accuracy.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Financial Reporting</h3>
                <p class="text-[#4A5568]">Monthly profit & loss statements, balance sheets, and cash flow reports.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Accounts Payable</h3>
                <p class="text-[#4A5568]">Manage vendor bills and ensure timely payments.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Accounts Receivable</h3>
                <p class="text-[#4A5568]">Track invoices and customer payments efficiently.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Expense Categorization</h3>
                <p class="text-[#4A5568]">Proper classification of expenses for tax optimization.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Payroll Support</h3>
                <p class="text-[#4A5568]">Assistance with payroll processing and employee records.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Tax Preparation Support</h3>
                <p class="text-[#4A5568]">Organized records ready for your tax professional.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Financial Analysis</h3>
                <p class="text-[#4A5568]">Insights and trends to help guide business decisions.</p>
            </div>
        </div>
        
        <div class="stagger-item flex items-start bg-white p-6 rounded-lg shadow-sm">
            <svg class="w-6 h-6 text-[#0066CC] mr-4 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <div>
                <h3 class="text-lg font-bold mb-2">Dedicated Support</h3>
                <p class="text-[#4A5568]">Direct access to your bookkeeping team whenever you need it.</p>
            </div>
        </div>
    </div>
</x-section>

<!-- What's Not Included Section -->
<x-section 
    title="What's Not Included">
    <div class="max-w-3xl mx-auto bg-[#F7FAFC] rounded-lg p-8 border border-[#E2E8F0]">
        <p class="text-[#4A5568] mb-6">To maintain focus and quality, our bookkeeping services do not include:</p>
        <ul class="space-y-3">
            <li class="flex items-start">
                <svg class="w-6 h-6 text-[#718096] mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="text-[#1a2332]">Tax filing and CPA services (we work with your tax professional)</span>
            </li>
            <li class="flex items-start">
                <svg class="w-6 h-6 text-blue-200 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="text-[#1a2332]">Financial audits or attestation services</span>
            </li>
            <li class="flex items-start">
                <svg class="w-6 h-6 text-blue-200 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="text-[#1a2332]">Legal or compliance consulting (non-bookkeeping related)</span>
            </li>
            <li class="flex items-start">
                <svg class="w-6 h-6 text-blue-200 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="text-[#1a2332]">Business strategy or management consulting</span>
            </li>
        </ul>
        <p class="text-[#4A5568] mt-6 text-sm italic">However, we're happy to collaborate with your existing advisors to ensure seamless financial management.</p>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-[#002147] text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-blue-200">Let's discuss how our bookkeeping services can support your business.</p>
        @guest
            <x-button href="{{ route('login') }}" variant="secondary" size="lg">
                Schedule Free Consultation
            </x-button>
        @else
            <x-button :href="auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard')" variant="secondary" size="lg">
                Go to Dashboard
            </x-button>
        @endguest
    </div>
</x-section>
@endsection

@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<!-- Hero Section -->
<x-hero 
    title="Simple, Streamlined Process"
    subtitle="Get professional bookkeeping services in three easy steps"
    backgroundImage="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1920&q=80"
    height="min-h-[70vh]">
</x-hero>

<!-- Process Steps Section -->
<x-section 
    title="How It Works"
    subtitle="From onboarding to ongoing support, we make it easy">
    <div class="max-w-4xl mx-auto space-y-20">
        <!-- Step 1 -->
        <div class="grid md:grid-cols-2 gap-12 items-center animate-section">
            <div class="order-2 md:order-1">
                <div class="bg-blue-100 text-blue-600 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mb-6">1</div>
                <h3 class="text-3xl font-bold mb-4">Connect Your Accounts</h3>
                <p class="text-lg text-gray-600 mb-4">
                    Securely link your bank accounts, credit cards, and business platforms. We integrate with QuickBooks, Xero, and all major financial institutions.
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Bank-level encryption and security
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Setup completed in under 15 minutes
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Automatic transaction syncing
                    </li>
                </ul>
            </div>
            <div class="order-1 md:order-2">
                <div class="bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl p-12 flex items-center justify-center">
                    <svg class="w-32 h-32 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="grid md:grid-cols-2 gap-12 items-center animate-section">
            <div>
                <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl p-12 flex items-center justify-center">
                    <svg class="w-32 h-32 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="bg-green-100 text-green-600 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mb-6">2</div>
                <h3 class="text-3xl font-bold mb-4">We Organize Everything</h3>
                <p class="text-lg text-gray-600 mb-4">
                    Our expert team reviews and categorizes all your transactions. We reconcile accounts monthly and ensure everything is accurate and compliant.
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Dedicated bookkeeper assigned to your account
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Real-time updates and notifications
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Monthly reconciliation and reports
                    </li>
                </ul>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="grid md:grid-cols-2 gap-12 items-center animate-section">
            <div class="order-2 md:order-1">
                <div class="bg-purple-100 text-purple-600 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mb-6">3</div>
                <h3 class="text-3xl font-bold mb-4">Access Insights & Grow</h3>
                <p class="text-lg text-gray-600 mb-4">
                    View real-time financial reports and insights through your dashboard. Make informed decisions backed by accurate data.
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        24/7 access to your financial data
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Monthly financial statements and analysis
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Tax-ready books year-round
                    </li>
                </ul>
            </div>
            <div class="order-1 md:order-2">
                <div class="bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl p-12 flex items-center justify-center">
                    <svg class="w-32 h-32 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Step 4 - Ongoing Support -->
        <div class="grid md:grid-cols-2 gap-12 items-center animate-section">
            <div>
                <div class="bg-gradient-to-br from-orange-100 to-orange-200 rounded-2xl p-12 flex items-center justify-center">
                    <svg class="w-32 h-32 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="bg-orange-100 text-orange-600 w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mb-6">+</div>
                <h3 class="text-3xl font-bold mb-4">Continuous Support</h3>
                <p class="text-lg text-gray-600 mb-4">
                    We're always here when you need us. Your dedicated team is available via email, phone, or chat to answer questions and provide guidance.
                </p>
                <ul class="space-y-2 text-gray-600">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Response within 24 hours
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Quarterly business reviews
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Scalable as your business grows
                    </li>
                </ul>
            </div>
        </div>
    </div>
</x-section>

<!-- Timeline Section -->
<x-section 
    title="Your First Month Timeline"
    background="bg-gray-50">
    <div class="max-w-3xl mx-auto">
        <div class="space-y-8">
            <div class="flex items-start animate-section">
                <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4 flex-shrink-0">1</div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Day 1-3: Onboarding</h4>
                    <p class="text-gray-600">Initial consultation, account setup, and connection of financial platforms.</p>
                </div>
            </div>
            
            <div class="flex items-start animate-section">
                <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4 flex-shrink-0">2</div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Week 1: Historical Review</h4>
                    <p class="text-gray-600">We review past transactions and establish your chart of accounts.</p>
                </div>
            </div>
            
            <div class="flex items-start animate-section">
                <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4 flex-shrink-0">3</div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Week 2-3: Active Management</h4>
                    <p class="text-gray-600">Daily transaction recording and categorization begins.</p>
                </div>
            </div>
            
            <div class="flex items-start animate-section">
                <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center font-bold mr-4 flex-shrink-0">4</div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Week 4: First Reports</h4>
                    <p class="text-gray-600">You receive your first complete monthly financial statements.</p>
                </div>
            </div>
        </div>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-gradient-to-r from-blue-600 to-purple-600 text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Get Started?</h2>
        <p class="text-xl mb-8 text-blue-100">Join hundreds of businesses that have streamlined their finances with BookKeep.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button href="{{ route('contact') }}" variant="secondary" size="lg">
                Schedule Free Consultation
            </x-button>
            <x-button href="{{ route('pricing') }}" size="lg" class="bg-white/10 text-white border-2 border-white hover:bg-white/20">
                View Pricing
            </x-button>
        </div>
    </div>
</x-section>
@endsection

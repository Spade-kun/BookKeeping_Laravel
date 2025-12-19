@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<!-- Hero Section -->
<x-hero 
    title="Financial Clarity for Your Business"
    subtitle="Professional bookkeeping services that give you complete control and transparency"
    backgroundImage="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=1920&q=80"
    :priority="true">
    <x-slot:cta>
        <x-button href="{{ route('contact') }}" size="lg">
            Get Started Today
        </x-button>
        <x-button href="{{ route('services') }}" variant="secondary" size="lg" class="ml-4">
            Learn More
        </x-button>
    </x-slot:cta>
</x-hero>

<!-- Value Proposition Section -->
<x-section 
    title="Why Choose Professional Bookkeeping?"
    subtitle="Focus on growing your business while we handle your finances"
    background="bg-[#F7FAFC] text-[#003366]">
    <div class="grid md:grid-cols-3 gap-8 stagger-container">
        <div class="stagger-item">
            <x-card 
                title="Save Time"
                description="Free up valuable hours every week. Let us handle the financial details while you focus on what matters most - your business growth.">
                <x-slot:icon>
                    <svg class="w-12 h-12 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-slot:icon>
            </x-card>
        </div>
        
        <div class="stagger-item">
            <x-card 
                title="Stay Compliant"
                description="Ensure accuracy and compliance with up-to-date financial regulations. Avoid costly mistakes and penalties with expert oversight.">
                <x-slot:icon>
                    <svg class="w-12 h-12 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </x-slot:icon>
            </x-card>
        </div>
        
        <div class="stagger-item">
            <x-card 
                title="Make Better Decisions"
                description="Access clear, actionable financial insights. Make informed decisions backed by accurate, real-time data.">
                <x-slot:icon>
                    <svg class="w-12 h-12 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </x-slot:icon>
            </x-card>
        </div>
    </div>
</x-section>

<!-- Who It's For Section -->
<x-section 
    title="Built for Modern Businesses"
    subtitle="Whether you're just starting or scaling up"
    background="bg-white text-[#003366]">
    <div class="grid md:grid-cols-3 gap-8 stagger-container">
        <div class="stagger-item text-center">
            <div class="bg-[#E6F2FF] w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-3 text-[#003366]">Startups</h3>
            <p class="text-[#4A5568]">Get your financial foundation right from day one. Scale with confidence.</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="bg-[#E6F2FF] w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-3 text-[#003366]">Small Businesses</h3>
            <p class="text-[#4A5568]">Streamline your operations with professional financial management.</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="bg-[#E6F2FF] w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-3 text-[#003366]">Growing Enterprises</h3>
            <p class="text-[#4A5568]">Advanced financial insights to support your expansion goals.</p>
        </div>
    </div>
</x-section>

<!-- Why Choose Us Section -->
<x-section 
    title="The Everly Advantage"
    background="bg-[#002147] text-white">
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 stagger-container">
        <div class="stagger-item text-center">
            <div class="text-4xl font-bold mb-2">99.9%</div>
            <p class="text-blue-200">Accuracy Rate</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="text-4xl font-bold mb-2">24/7</div>
            <p class="text-blue-200">Access to Your Data</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="text-4xl font-bold mb-2">< 24hr</div>
            <p class="text-blue-200">Response Time</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="text-4xl font-bold mb-2">500+</div>
            <p class="text-blue-200">Happy Clients</p>
        </div>
    </div>
</x-section>

<!-- Process Preview -->
<x-section 
    title="Simple, Transparent Process"
    subtitle="Get started in minutes, not days"
    background="bg-[#F7FAFC] text-[#003366]">
    <div class="grid md:grid-cols-3 gap-8 stagger-container">
        <div class="stagger-item">
            <div class="bg-white rounded-lg p-8 text-center shadow-md">
                <div class="bg-[#E6F2FF] text-[#0066CC] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                <h3 class="text-xl font-bold mb-2 text-[#003366]">Connect</h3>
                <p class="text-[#4A5568]">Link your accounts securely. We integrate with all major platforms.</p>
            </div>
        </div>
        
        <div class="stagger-item">
            <div class="bg-white rounded-lg p-8 text-center shadow-md">
                <div class="bg-[#E6F2FF] text-[#0066CC] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                <h3 class="text-xl font-bold mb-2 text-[#003366]">Review</h3>
                <p class="text-[#4A5568]">We organize and categorize your transactions automatically.</p>
            </div>
        </div>
        
        <div class="stagger-item">
            <div class="bg-white rounded-lg p-8 text-center shadow-md">
                <div class="bg-[#E6F2FF] text-[#0066CC] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                <h3 class="text-xl font-bold mb-2 text-[#003366]">Grow</h3>
                <p class="text-[#4A5568]">Access insights and reports to drive business decisions.</p>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-12">
        <x-button href="{{ route('how-it-works') }}" size="lg">
            Learn How It Works
        </x-button>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-gradient-to-r from-[#0066CC] to-[#003366] text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Ready to Transform Your Finances?</h2>
        <p class="text-xl mb-8 text-blue-100">Join hundreds of businesses that trust BookKeep with their financial management.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button href="{{ route('contact') }}" variant="secondary" size="lg">
                Start Free Consultation
            </x-button>
            <x-button href="{{ route('pricing') }}" variant="primary" size="lg">
                View Pricing
            </x-button>
        </div>
    </div>
</x-section>
@endsection

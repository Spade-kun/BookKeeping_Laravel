@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<!-- Hero Section -->
<x-hero 
    title="Let's Talk"
    subtitle="Ready to transform your business finances? Get in touch with our team"
    backgroundImage="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=1920&q=80"
    height="min-h-[70vh]">
</x-hero>

<!-- Contact Form Section -->
<x-section 
    title="Send Us a Message"
    subtitle="We'll respond within 24 hours">
    <div class="max-w-3xl mx-auto">
        @if(session('success'))
            <div class="bg-[#E6F2FF] border border-[#0066CC] text-[#003366] px-6 py-4 rounded-lg mb-8 animate-section">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST" class="bg-white rounded-lg shadow-lg p-8 space-y-6" x-data="contactForm()">
            @csrf
            
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-semibold text-[#1a2332] mb-2">Full Name *</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    required
                    value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent transition @error('name') border-red-500 @enderror"
                    placeholder="John Doe"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-semibold text-[#1a2332] mb-2">Email Address *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    required
                    value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent transition @error('email') border-red-500 @enderror"
                    placeholder="john@company.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone Field -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-[#1a2332] mb-2">Phone Number</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone"
                    value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent transition @error('phone') border-red-500 @enderror"
                    placeholder="(555) 123-4567"
                >
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Message Field -->
            <div>
                <label for="message" class="block text-sm font-semibold text-[#1a2332] mb-2">Message *</label>
                <textarea 
                    id="message" 
                    name="message" 
                    required
                    rows="6"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-transparent transition resize-none @error('message') border-red-500 @enderror"
                    placeholder="Tell us about your business and how we can help..."
                >{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <x-button type="submit" class="w-full" size="lg">
                    Send Message
                </x-button>
                <p class="text-sm text-[#4A5568] text-center mt-4">
                    We typically respond within 24 hours
                </p>
            </div>
        </form>
    </div>
</x-section>

<!-- Contact Info Section -->
<x-section 
    title="Other Ways to Reach Us"
    background="bg-[#F7FAFC]">
    <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto stagger-container">
        <!-- Email -->
        <div class="stagger-item bg-white rounded-lg p-8 text-center shadow-md hover-card">
            <div class="bg-[#E6F2FF] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Email</h3>
            <a href="mailto:hello@bookkeep.com" class="text-[#0066CC] hover:underline">hello@bookkeep.com</a>
        </div>

        <!-- Phone -->
        <div class="stagger-item bg-white rounded-lg p-8 text-center shadow-md hover-card">
            <div class="bg-[#E6F2FF] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Phone</h3>
            <a href="tel:+15551234567" class="text-[#0066CC] hover:underline">+1 (555) 123-4567</a>
        </div>

        <!-- Office Hours -->
        <div class="stagger-item bg-white rounded-lg p-8 text-center shadow-md hover-card">
            <div class="bg-[#E6F2FF] w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-[#0066CC]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Office Hours</h3>
            <p class="text-[#4A5568]">Mon - Fri: 9am - 6pm EST<br>Weekend: By appointment</p>
        </div>
    </div>
</x-section>

<!-- FAQ Section -->
<x-section 
    title="Common Questions">
    <div class="max-w-3xl mx-auto space-y-4">
        <div class="bg-white border rounded-lg p-6 animate-section">
            <h3 class="text-lg font-bold mb-2">How quickly can we get started?</h3>
            <p class="text-[#4A5568]">We can typically onboard new clients within 3-5 business days after the initial consultation.</p>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section">
            <h3 class="text-lg font-bold mb-2">Do you offer free consultations?</h3>
            <p class="text-[#4A5568]">Yes! We offer a free 30-minute consultation to understand your needs and explain how we can help.</p>
        </div>

        <div class="bg-white border rounded-lg p-6 animate-section">
            <h3 class="text-lg font-bold mb-2">What information do you need from me?</h3>
            <p class="text-[#4A5568]">We'll need access to your accounting software and bank accounts. We'll guide you through the secure connection process.</p>
        </div>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-[#002147] text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Prefer to Talk First?</h2>
        <p class="text-xl mb-8 text-blue-200">Schedule a free consultation call with our team.</p>
        <x-button href="#" variant="secondary" size="lg">
            Schedule Call
        </x-button>
    </div>
</x-section>

@push('scripts')
<script>
function contactForm() {
    return {
        init() {
            // Add any form-specific Alpine.js logic here
        }
    }
}
</script>
@endpush
@endsection

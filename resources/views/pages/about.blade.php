@extends('layouts.app')

@section('title', $title)
@section('description', $description)

@section('content')
<!-- Hero Section -->
<x-hero 
    title="Financial Expertise You Can Trust"
    subtitle="Dedicated to helping businesses thrive through exceptional bookkeeping"
    backgroundImage="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1920&q=80"
    height="min-h-[70vh]">
</x-hero>

<!-- Mission Section -->
<x-section 
    title="Our Mission"
    subtitle="Empowering businesses with clarity and confidence">
    <div class="max-w-3xl mx-auto text-center">
        <p class="text-xl text-gray-700 leading-relaxed mb-6">
            At BookKeep, we believe every business deserves clear, accurate financial insights. 
            Our mission is to remove the complexity from bookkeeping, allowing entrepreneurs and 
            business owners to focus on what they do best—growing their companies.
        </p>
        <p class="text-lg text-gray-600 leading-relaxed">
            We combine expert knowledge with modern technology to deliver bookkeeping services 
            that are reliable, transparent, and tailored to your unique business needs.
        </p>
    </div>
</x-section>

<!-- Values Section -->
<x-section 
    title="Our Values"
    background="bg-gray-50">
    <div class="grid md:grid-cols-3 gap-8 stagger-container">
        <div class="stagger-item text-center">
            <div class="bg-blue-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-3">Integrity</h3>
            <p class="text-gray-600">We handle your finances with the highest standards of accuracy and ethics.</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-3">Innovation</h3>
            <p class="text-gray-600">Leveraging technology to provide efficient, modern bookkeeping solutions.</p>
        </div>
        
        <div class="stagger-item text-center">
            <div class="bg-purple-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold mb-3">Partnership</h3>
            <p class="text-gray-600">We see ourselves as an extension of your team, invested in your success.</p>
        </div>
    </div>
</x-section>

<!-- Story Section -->
<x-section 
    title="Our Story">
    <div class="max-w-3xl mx-auto">
        <div class="prose prose-lg max-w-none">
            <p class="text-gray-700 leading-relaxed mb-4">
                BookKeep was founded by a team of certified accountants and technology professionals 
                who saw firsthand how traditional bookkeeping practices were failing modern businesses. 
                Small business owners were either spending countless hours managing their own books or 
                paying excessive fees for services that lacked transparency.
            </p>
            <p class="text-gray-700 leading-relaxed mb-4">
                We set out to change that. By combining expert accounting knowledge with cutting-edge 
                technology, we created a bookkeeping service that's accessible, affordable, and built 
                for the way businesses operate today.
            </p>
            <p class="text-gray-700 leading-relaxed">
                Today, we're proud to serve hundreds of businesses across various industries, helping 
                them achieve financial clarity and make informed decisions that drive growth.
            </p>
        </div>
    </div>
</x-section>

<!-- Stats Section -->
<x-section 
    background="bg-black text-white">
    <div class="grid md:grid-cols-4 gap-8 stagger-container text-center">
        <div class="stagger-item">
            <div class="text-5xl font-bold mb-2">500+</div>
            <p class="text-gray-400">Active Clients</p>
        </div>
        
        <div class="stagger-item">
            <div class="text-5xl font-bold mb-2">10+</div>
            <p class="text-gray-400">Years Experience</p>
        </div>
        
        <div class="stagger-item">
            <div class="text-5xl font-bold mb-2">99.9%</div>
            <p class="text-gray-400">Accuracy Rate</p>
        </div>
        
        <div class="stagger-item">
            <div class="text-5xl font-bold mb-2">$50M+</div>
            <p class="text-gray-400">Managed Annually</p>
        </div>
    </div>
</x-section>

<!-- Team Section -->
<x-section 
    title="Our Expertise"
    subtitle="Led by certified professionals"
    background="bg-gray-50">
    <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto stagger-container">
        <div class="stagger-item bg-white rounded-lg p-8 text-center shadow-md">
            <div class="w-24 h-24 bg-blue-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Certified Accountants</h3>
            <p class="text-gray-600">All team members hold professional certifications and undergo continuous training.</p>
        </div>
        
        <div class="stagger-item bg-white rounded-lg p-8 text-center shadow-md">
            <div class="w-24 h-24 bg-green-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Industry Specialists</h3>
            <p class="text-gray-600">Deep expertise across multiple industries including tech, retail, and professional services.</p>
        </div>
        
        <div class="stagger-item bg-white rounded-lg p-8 text-center shadow-md">
            <div class="w-24 h-24 bg-purple-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-2">Technology Driven</h3>
            <p class="text-gray-600">Our tech team ensures seamless integration and data security for all clients.</p>
        </div>
    </div>
</x-section>

<!-- CTA Section -->
<x-section 
    background="bg-gradient-to-r from-blue-600 to-purple-600 text-white"
    padding="py-20">
    <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Let's Work Together</h2>
        <p class="text-xl mb-8 text-blue-100">Discover how BookKeep can transform your business finances.</p>
        <x-button href="{{ route('contact') }}" variant="secondary" size="lg">
            Get in Touch
        </x-button>
    </div>
</x-section>
@endsection

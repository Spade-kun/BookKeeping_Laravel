<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Performance & SEO Optimization -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0066CC">
    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Everly BookKeeping - Professional Bookkeeping Services')</title>
    <meta name="description" content="@yield('description', 'Expert bookkeeping services for businesses. Streamline your finances with our professional accounting solutions.')">
    <meta name="keywords" content="bookkeeping, accounting, financial services, business accounting, everly bookkeeping">
    <meta name="author" content="Everly BookKeeping">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph -->
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="Everly BookKeeping">
    <meta property="og:title" content="@yield('title', 'Everly BookKeeping - Professional Bookkeeping Services')">
    <meta property="og:description" content="@yield('description', 'Expert bookkeeping services for businesses.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/EverlyLogo.jpeg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Everly BookKeeping - Professional Bookkeeping Services')">
    <meta name="twitter:description" content="@yield('description', 'Expert bookkeeping services for businesses.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/EverlyLogo.jpeg'))">
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/EverlyLogo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/EverlyLogo.jpeg') }}">
    
    <!-- Fonts with display swap for performance -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="fixed w-full top-0 z-50 bg-transparent transition-all duration-300" x-data="{ mobileMenuOpen: false, servicesDropdown: false }">
        <nav class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center hover:opacity-80 transition">
                    <img src="{{ asset('images/EverlyLogo.jpeg') }}" alt="Everly BookKeeping Logo" class="w-11 h-11 rounded-full object-cover header-logo">
                    <span class="text-xl font-bold text-white header-text ml-4">Everly</span>
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('services') }}" class="text-sm font-medium header-nav hover:opacity-80 transition">
                        Services
                    </a>
                    <a href="{{ route('how-it-works') }}" class="text-sm font-medium header-nav hover:opacity-80 transition">
                        How It Works
                    </a>
                    <a href="{{ route('pricing') }}" class="text-sm font-medium header-nav hover:opacity-80 transition">
                        Pricing
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium header-nav hover:opacity-80 transition">
                        About
                    </a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium header-nav hover:opacity-80 transition">
                        Contact
                    </a>
                    <a href="{{ route('contact') }}" class="bg-white text-[#0066CC] px-6 py-2 rounded-full text-sm font-medium hover:bg-[#F0F7FF] transition header-cta">
                        Get Started
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white header-text focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="md:hidden fixed inset-0 bg-white z-50 pt-20"
                 style="display: none;">
                <div class="flex flex-col items-center space-y-8 py-8">
                    <a href="{{ route('services') }}" class="text-lg font-medium text-[#003366] hover:text-[#0066CC]">Services</a>
                    <a href="{{ route('how-it-works') }}" class="text-lg font-medium text-[#003366] hover:text-[#0066CC]">How It Works</a>
                    <a href="{{ route('pricing') }}" class="text-lg font-medium text-[#003366] hover:text-[#0066CC]">Pricing</a>
                    <a href="{{ route('about') }}" class="text-lg font-medium text-[#003366] hover:text-[#0066CC]">About</a>
                    <a href="{{ route('contact') }}" class="text-lg font-medium text-[#003366] hover:text-[#0066CC]">Contact</a>
                    <a href="{{ route('contact') }}" class="btn-primary bg-[#0066CC] text-white px-8 py-3 rounded-full text-lg font-medium hover:bg-[#0055B8]">Get Started</a>
                </div>
                <button @click="mobileMenuOpen = false" class="absolute top-6 right-6 text-[#003366]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#002147] text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Everly BookKeeping</h3>
                    <p class="text-white text-sm opacity-90">Professional Bookkeeping Services for modern businesses.</p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4 text-white">Company</h4>
                    <ul class="space-y-2 text-sm text-white opacity-80">
                        <li><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">Contact</a></li>
                        <li><a href="#" class="footer-link">Careers</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="font-semibold mb-4 text-white">Services</h4>
                    <ul class="space-y-2 text-sm text-white opacity-80">
                        <li><a href="{{ route('services') }}" class="footer-link">Bookkeeping</a></li>
                        <li><a href="{{ route('pricing') }}" class="footer-link">Pricing</a></li>
                        <li><a href="{{ route('how-it-works') }}" class="footer-link">How It Works</a></li>
                    </ul>
                </div>
                
                <!-- Legal -->
                <div>
                    <h4 class="font-semibold mb-4 text-white">Legal</h4>
                    <ul class="space-y-2 text-sm text-white opacity-80">
                        <li><a href="#" class="footer-link">Privacy Policy</a></li>
                        <li><a href="#" class="footer-link">Terms of Service</a></li>
                        <li><a href="#" class="footer-link">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-900 mt-8 pt-8 text-center text-sm text-white opacity-70">
                <p>&copy; {{ date('Y') }} Everly BookKeeping. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Structured Data for SEO -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Everly BookKeeping',
        'description' => 'Professional bookkeeping services for modern businesses',
        'url' => url('/'),
        'logo' => asset('images/EverlyLogo.jpeg'),
        'image' => asset('images/EverlyLogo.jpeg'),
        'telephone' => '+1-XXX-XXX-XXXX',
        'priceRange' => '$$',
        'address' => [
            '@type' => 'PostalAddress',
            'addressCountry' => 'US'
        ],
        'sameAs' => [
            'https://www.facebook.com/everlybookkeeping',
            'https://www.linkedin.com/company/everlybookkeeping',
            'https://twitter.com/everlybookkeep'
        ],
        'serviceType' => ['Bookkeeping', 'Accounting', 'Financial Services'],
        'areaServed' => [
            '@type' => 'Country',
            'name' => 'United States'
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

    @stack('scripts')
</body>
</html>

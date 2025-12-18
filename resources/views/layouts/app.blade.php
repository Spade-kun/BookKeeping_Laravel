<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', 'Professional Bookkeeping Services')</title>
    <meta name="description" content="@yield('description', 'Expert bookkeeping services for businesses. Streamline your finances with our professional accounting solutions.')">
    <meta name="keywords" content="bookkeeping, accounting, financial services, business accounting">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'Professional Bookkeeping Services')">
    <meta property="og:description" content="@yield('description', 'Expert bookkeeping services for businesses.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Professional Bookkeeping Services')">
    <meta name="twitter:description" content="@yield('description', 'Expert bookkeeping services for businesses.')">
    
    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @if(app()->environment('production'))
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <script type="module" src="{{ asset('build/assets/app.js') }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    @stack('styles')
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="fixed w-full top-0 z-50 bg-transparent transition-all duration-300" x-data="{ mobileMenuOpen: false, servicesDropdown: false }">
        <nav class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-white header-text hover:opacity-80 transition">
                    BookKeep
                </a>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('services') }}" class="text-sm font-medium text-white header-text hover:opacity-80 transition">
                        Services
                    </a>
                    <a href="{{ route('how-it-works') }}" class="text-sm font-medium text-white header-text hover:opacity-80 transition">
                        How It Works
                    </a>
                    <a href="{{ route('pricing') }}" class="text-sm font-medium text-white header-text hover:opacity-80 transition">
                        Pricing
                    </a>
                    <a href="{{ route('about') }}" class="text-sm font-medium text-white header-text hover:opacity-80 transition">
                        About
                    </a>
                    <a href="{{ route('contact') }}" class="text-sm font-medium text-white header-text hover:opacity-80 transition">
                        Contact
                    </a>
                    <a href="{{ route('contact') }}" class="btn-primary bg-white text-black px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-100 transition header-cta">
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
                    <a href="{{ route('services') }}" class="text-lg font-medium text-gray-900 hover:text-gray-600">Services</a>
                    <a href="{{ route('how-it-works') }}" class="text-lg font-medium text-gray-900 hover:text-gray-600">How It Works</a>
                    <a href="{{ route('pricing') }}" class="text-lg font-medium text-gray-900 hover:text-gray-600">Pricing</a>
                    <a href="{{ route('about') }}" class="text-lg font-medium text-gray-900 hover:text-gray-600">About</a>
                    <a href="{{ route('contact') }}" class="text-lg font-medium text-gray-900 hover:text-gray-600">Contact</a>
                    <a href="{{ route('contact') }}" class="btn-primary bg-black text-white px-8 py-3 rounded-full text-lg font-medium">Get Started</a>
                </div>
                <button @click="mobileMenuOpen = false" class="absolute top-6 right-6 text-gray-900">
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
    <footer class="bg-black text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4">BookKeep</h3>
                    <p class="text-gray-400 text-sm">Professional bookkeeping services for modern businesses.</p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('about') }}" class="hover:text-white transition">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Careers</a></li>
                    </ul>
                </div>
                
                <!-- Services -->
                <div>
                    <h4 class="font-semibold mb-4">Services</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('services') }}" class="hover:text-white transition">Bookkeeping</a></li>
                        <li><a href="{{ route('pricing') }}" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="{{ route('how-it-works') }}" class="hover:text-white transition">How It Works</a></li>
                    </ul>
                </div>
                
                <!-- Legal -->
                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} BookKeep. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

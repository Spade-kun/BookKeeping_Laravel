<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>@yield('title', 'Dashboard') - Everly Bookkeeping</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @if(env('VITE_DEV_SERVER_ENABLED', true))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $cssFile = $manifest['resources/css/app.css']['file'] ?? '';
            $jsFile = $manifest['resources/js/app.js']['file'] ?? '';
        @endphp
        @if($cssFile)
            <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
        @endif
        @if($jsFile)
            <script type="module" src="{{ asset('build/' . $jsFile) }}" defer></script>
        @endif
    @endif

    @stack('styles')
</head>
<body class="antialiased bg-[#F7FAFC]" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-[#002147] text-white">
                <!-- Logo -->
                <div class="flex items-center justify-center h-20 border-b border-blue-900">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/EverlyLogo.jpeg') }}" alt="Everly Bookkeeping" class="w-10 h-10 rounded-full object-cover">
                        <span class="ml-3 text-lg font-bold text-white">Everly Bookkeeping</span>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    @yield('sidebar')
                </nav>

                <!-- User Info -->
                <div class="border-t border-blue-900 p-4">
                    <div class="flex items-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-[#0066CC] flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-blue-200 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 md:hidden bg-gray-900 bg-opacity-75"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-cloak></div>

        <div x-show="sidebarOpen"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-[#002147] text-white md:hidden"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             x-cloak>
            <!-- Mobile sidebar content (same as desktop) -->
            <div class="flex flex-col h-full">
                <div class="flex items-center justify-between h-20 px-4 border-b border-blue-900">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/EverlyLogo.jpeg') }}" alt="Everly Bookkeeping" class="w-10 h-10 rounded-full object-cover">
                        <span class="ml-3 text-lg font-bold text-white">Everly</span>
                    </a>
                    <button @click="sidebarOpen = false" class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <nav class="flex-1 px-4 py-6 space-y-2">
                    @yield('sidebar')
                </nav>
                <div class="border-t border-blue-900 p-4">
                    <div class="flex items-center">
                        @if(auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-10 h-10 rounded-full object-cover">
                        @else
                            <div class="w-10 h-10 rounded-full bg-[#0066CC] flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="ml-3 flex-1">
                            <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-blue-200 truncate">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="w-full bg-blue-900 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-white border-b border-gray-200 h-20 flex items-center px-6">
                <button @click="sidebarOpen = true" class="md:hidden text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="text-2xl font-bold text-[#003366] ml-4 md:ml-0">@yield('page-title', 'Dashboard')</h1>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

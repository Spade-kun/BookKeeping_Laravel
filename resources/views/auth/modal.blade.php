<!-- Auth Modal -->
<div x-data="{ open: false }" 
     @open-auth-modal.window="open = true" 
     @keydown.escape.window="open = false" 
     x-cloak>
    <!-- Modal Overlay -->
    <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            
            <!-- Background overlay -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" 
                 @click="open = false"></div>

            <!-- Modal Panel -->
            <div class="flex min-h-screen items-center justify-center p-4">
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="relative w-full max-w-md transform rounded-2xl bg-white p-8 shadow-2xl transition-all"
                     @click.away="open = false">
                    
                    <!-- Close button -->
                    <button @click="open = false" 
                            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Modal Content -->
                    <div class="text-center">
                        <!-- Logo -->
                        <div class="mx-auto mb-6">
                            <img src="{{ asset('images/EverlyLogo.jpeg') }}" 
                                 alt="Everly Bookkeeping" 
                                 class="w-20 h-20 rounded-full mx-auto object-cover">
                        </div>

                        <!-- Title -->
                        <h2 class="text-3xl font-bold text-[#003366] mb-3">
                            Get Started with Everly Bookkeeping
                        </h2>

                        <!-- Subtitle -->
                        <p class="text-[#4A5568] mb-8">
                            Sign in with your Google account to access your personalized dashboard.
                        </p>

                        <!-- Google Sign In Button -->
                        <a href="{{ route('auth.google') }}" 
                           class="inline-flex items-center justify-center w-full bg-white border-2 border-[#E2E8F0] hover:border-[#0066CC] hover:bg-[#F7FAFC] text-[#003366] font-medium px-6 py-4 rounded-full transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Sign in with Google
                        </a>

                        <!-- Privacy Note -->
                        <p class="text-xs text-[#718096] mt-6">
                            By signing in, you agree to our Terms of Service and Privacy Policy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
</div>

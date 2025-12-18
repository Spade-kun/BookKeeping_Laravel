@props([
    'title',
    'subtitle' => null,
    'backgroundImage' => null,
    'backgroundVideo' => null,
    'height' => 'min-h-screen',
    'align' => 'center'
])

<section class="relative {{ $height }} flex items-{{ $align }} justify-center overflow-hidden">
    <!-- Background Media -->
    @if($backgroundVideo)
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ $backgroundVideo }}" type="video/mp4">
        </video>
    @elseif($backgroundImage)
        <img src="{{ $backgroundImage }}" alt="" class="absolute inset-0 w-full h-full object-cover" loading="lazy">
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-gray-800"></div>
    @endif
    
    <!-- Overlay -->
    <div class="hero-overlay"></div>
    
    <!-- Content -->
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center text-white">
        <h1 class="hero-headline text-5xl md:text-7xl font-bold mb-6 leading-tight">
            {{ $title }}
        </h1>
        
        @if($subtitle)
            <p class="hero-subheadline text-xl md:text-2xl mb-8 text-gray-200">
                {{ $subtitle }}
            </p>
        @endif
        
        @isset($cta)
            <div class="hero-cta">
                {{ $cta }}
            </div>
        @endisset
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

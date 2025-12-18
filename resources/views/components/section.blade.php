@props([
    'title' => null,
    'subtitle' => null,
    'background' => 'bg-white',
    'padding' => 'py-20',
    'animate' => true
])

<section class="{{ $background }} {{ $padding }} {{ $animate ? 'animate-section' : '' }}">
    <div class="max-w-7xl mx-auto px-6">
        @if($title)
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">{{ $title }}</h2>
                @if($subtitle)
                    <p class="text-xl text-gray-600">{{ $subtitle }}</p>
                @endif
            </div>
        @endif
        
        <div>
            {{ $slot }}
        </div>
    </div>
</section>

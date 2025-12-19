@props([
    'icon' => null,
    'title',
    'description',
    'hover' => true
])

<div class="bg-white rounded-lg p-8 border border-[#E2E8F0] {{ $hover ? 'hover-card shadow-md' : '' }} h-full flex flex-col">
    @if($icon)
        <div class="mb-4">
            {!! $icon !!}
        </div>
    @endif
    
    <h3 class="text-2xl font-bold mb-3 text-[#003366]">{{ $title }}</h3>
    <p class="text-[#4A5568] leading-relaxed flex-grow">{{ $description }}</p>
    
    @isset($footer)
        <div class="mt-6">
            {{ $footer }}
        </div>
    @endisset
</div>

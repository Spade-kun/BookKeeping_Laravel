@props([
    'icon' => null,
    'title',
    'description',
    'hover' => true
])

<div class="bg-white rounded-lg p-8 {{ $hover ? 'hover-card shadow-md' : '' }}">
    @if($icon)
        <div class="mb-4">
            {!! $icon !!}
        </div>
    @endif
    
    <h3 class="text-2xl font-bold mb-3">{{ $title }}</h3>
    <p class="text-gray-600 leading-relaxed">{{ $description }}</p>
    
    @isset($footer)
        <div class="mt-6">
            {{ $footer }}
        </div>
    @endisset
</div>

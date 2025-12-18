@props([
    'title',
    'price',
    'period' => 'month',
    'features' => [],
    'highlighted' => false,
    'ctaText' => 'Get Started',
    'ctaLink' => '#'
])

<div class="bg-white rounded-2xl p-8 {{ $highlighted ? 'ring-4 ring-black shadow-2xl transform scale-105' : 'shadow-lg' }} hover-card">
    @if($highlighted)
        <div class="bg-black text-white text-sm font-semibold px-4 py-1 rounded-full inline-block mb-4">
            Most Popular
        </div>
    @endif
    
    <h3 class="text-2xl font-bold mb-2">{{ $title }}</h3>
    
    <div class="mb-6">
        <span class="text-5xl font-bold">${{ $price }}</span>
        <span class="text-gray-600">/ {{ $period }}</span>
    </div>
    
    <ul class="space-y-3 mb-8">
        @foreach($features as $feature)
            <li class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="text-gray-700">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>
    
    <x-button :href="$ctaLink" variant="{{ $highlighted ? 'primary' : 'secondary' }}" class="w-full">
        {{ $ctaText }}
    </x-button>
</div>

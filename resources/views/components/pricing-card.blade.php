@props([
    'title',
    'price',
    'period' => 'month',
    'features' => [],
    'highlighted' => false,
    'ctaText' => 'Get Started',
    'ctaLink' => '#',
    'useAuthModal' => false
])

<div class="bg-white rounded-2xl p-8 border {{ $highlighted ? 'ring-4 ring-[#0066CC] shadow-2xl transform scale-105 border-[#0066CC]' : 'shadow-lg border-[#E2E8F0]' }} hover-card">
    @if($highlighted)
        <div class="bg-[#0066CC] text-white text-sm font-semibold px-4 py-1 rounded-full inline-block mb-4">
            Most Popular
        </div>
    @endif
    
    <h3 class="text-2xl font-bold mb-2 text-[#003366]">{{ $title }}</h3>
    
    <div class="mb-6">
        <span class="text-5xl font-bold text-[#003366]">${{ $price }}</span>
        <span class="text-[#4A5568]">/ {{ $period }}</span>
    </div>
    
    <ul class="space-y-3 mb-8">
        @foreach($features as $feature)
            <li class="flex items-start">
                <svg class="w-6 h-6 text-[#0066CC] mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="text-[#1a2332]">{{ $feature }}</span>
            </li>
        @endforeach
    </ul>
    
    @if($ctaText === 'Get Started' || $useAuthModal)
        @guest
            <x-button href="{{ route('login') }}" variant="{{ $highlighted ? 'primary' : 'secondary' }}" class="w-full">
                {{ $ctaText }}
            </x-button>
        @else
            <x-button :href="auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard')" variant="{{ $highlighted ? 'primary' : 'secondary' }}" class="w-full">
                Go to Dashboard
            </x-button>
        @endguest
    @else
        <x-button :href="$ctaLink" variant="{{ $highlighted ? 'primary' : 'secondary' }}" class="w-full">
            {{ $ctaText }}
        </x-button>
    @endif
</div>

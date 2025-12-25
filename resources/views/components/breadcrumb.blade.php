@props(['items' => []])

<nav class="flex items-center space-x-2 text-sm text-gray-600 mb-6">
    <a href="{{ route('dashboard') }}" class="hover:text-[#0066CC] transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
        </svg>
    </a>
    
    @foreach($items as $item)
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
        
        @if($loop->last)
            <span class="font-medium text-[#003366]">{{ $item['label'] }}</span>
        @else
            <a href="{{ $item['url'] }}" class="hover:text-[#0066CC] transition-colors">
                {{ $item['label'] }}
            </a>
        @endif
    @endforeach
</nav>

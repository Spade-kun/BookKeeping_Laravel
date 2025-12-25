@props(['route' => '', 'placeholder' => 'Search...', 'value' => ''])

<form action="{{ $route }}" method="GET" class="w-full">
    <div class="relative">
        <input type="text" 
               name="search"
               value="{{ $value }}"
               placeholder="{{ $placeholder }}" 
               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC] transition-all shadow-sm hover:shadow-md"
               @if(!$route) @input="$dispatch('search', $event.target.value)" @endif>
        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        @if($route && $value)
            <a href="{{ $route }}" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        @endif
    </div>
    {{ $slot }}
</form>

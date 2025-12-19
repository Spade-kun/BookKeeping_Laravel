@props([
    'href' => '#',
    'variant' => 'primary',
    'size' => 'md'
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-[#0066CC] text-white hover:bg-[#0055B8] focus:ring-[#0066CC] shadow-lg shadow-blue-500/20',
    'secondary' => 'bg-white text-[#0066CC] border-2 border-[#0066CC] hover:bg-[#0066CC] hover:text-white focus:ring-[#0066CC]',
    'outline' => 'bg-transparent text-[#003366] border border-[#CBD5E0] hover:bg-[#F7FAFC] focus:ring-[#0066CC]',
];

$sizes = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-6 py-3 text-base',
    'lg' => 'px-8 py-4 text-lg',
];

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href !== '#')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif

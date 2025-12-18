@props([
    'href' => '#',
    'variant' => 'primary',
    'size' => 'md'
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

$variants = [
    'primary' => 'bg-black text-white hover:bg-gray-800 focus:ring-black',
    'secondary' => 'bg-white text-black border-2 border-black hover:bg-gray-100 focus:ring-black',
    'outline' => 'bg-transparent text-black border border-gray-300 hover:bg-gray-50 focus:ring-gray-300',
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

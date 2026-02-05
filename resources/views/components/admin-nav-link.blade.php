@props(['active', 'icon' => ''])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 bg-indigo-600 text-white rounded-lg transition-colors'
            : 'flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="mr-3">
       @if($icon == 'home') 🏠 @elseif($icon == 'users') 🚣 @elseif($icon == 'ship') 🚤 @else 📄 @endif
    </span>
    <span class="font-medium">{{ $slot }}</span>
</a>
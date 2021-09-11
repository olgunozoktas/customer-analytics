@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-yellow-200 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out gap-1.5'
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-white hover:text-yellow-400 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out gap-1.5';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

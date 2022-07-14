@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block py-2 pr-4 pl-3 text-white bg-gray-900 rounded dark:text-white bg-opacity-30'
            : 'block py-2 pr-4 pl-3 text-white border-b border-gray-100 hover:bg-gray-900 hover:bg-opacity-20 md:border-0 md:hover:text-white dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-900 dark:hover:bg-opacity-20 dark:hover:text-white dark:border-gray-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

@props(['active' => false])

@php
$classes = 'block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white transition duration-150 ease-in-out';
if ($active) {
    $classes .= ' bg-blue-600 dark:bg-blue-500 text-white hover:bg-blue-800 dark:hover:bg-blue-600';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>

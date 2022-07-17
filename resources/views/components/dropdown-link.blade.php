@props(['active' => false])

@php
$classes = 'block py-2 px-4 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white transition duration-150 ease-in-out';
if ($active) {
    $classes .= ' active';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>

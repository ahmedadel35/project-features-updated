@props([
    'type' => 'button',
    'icon' => null,
    'desc' => ''
    ])

    <button {{ $attributes->merge(['class' => 'btn']) }}
        type="{{ $type }}" aria-describedby="{{ $desc }}" x-data="{
        busy: false,
    }" x-on:click="busy = true" x-bind:disabled='busy'>
        @if($icon)
            @svg($icon, ['x-show' => '!busy', 'x-clock'])
            @endif
            <x-btn-spinner x-show='busy' />
            {{ $slot }}
    </button>
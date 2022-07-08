@props([
    'type' => 'button',
    'icon' => null,
    'desc' => '',
    'busy' => 'busy'
    ])

    <button {{ $attributes->merge(['class' => 'btn']) }}
        type="{{ $type }}" aria-describedby="{{ $desc }}" @if($busy === 'busy') x-data="{
        busy: false,
    }" x-on:click="busy = true" @endif>
        @if($icon)
            @svg($icon, ['x-show' => '!' . $busy, 'x-clock'])
            @endif
            <x-btn-spinner x-show='{{ $busy }}' />
            {{ $slot }}
    </button>
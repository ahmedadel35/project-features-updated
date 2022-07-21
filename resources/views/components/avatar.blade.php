{{-- keep this line updated with project controller invite method --}}
@props(['src','title','hash'=> '','id'=> 'a'.random_int(10, 9999)])

<div class="overflow-hidden w-10 h-10" id="avatar-{{ $hash }}" title="{{$title}}">
    <div id='{{ $id }}-loader'
        class="relative w-10 h-10 overflow-hidden bg-gray-100 dark:bg-gray-600 rounded-full animate-pulse">
        <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
            </path>
        </svg>
    </div>

    <img id='{{ $id }}' src="{{ $src }}"
        class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800 hidden"
        onload="lazyLoadIt('{{ $id }}')" title="{{ $title }}" {{ $attributes }} />
</div>

@props([
    'color' => '',
    'type' => 'button',
])

<button class="btn {{$color}}" type="{{$type}}" aria-describedby="{{$color . $type}}">

    
</button>
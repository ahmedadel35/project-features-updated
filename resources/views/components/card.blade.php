@props([
    'id' => '',
    'url' => '#',
    'class' => 'w-full sm:w-1/2 md:w-1/3 p-3 sm:px-2 md:px-4',
    ])

    <div class="{{$class}}" id="{{ $id }}">
        <div class="p-3 max-w-sm card-bg">
            <a href="{{ $url }}">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $title }}
                </h5>
            </a>

            {{ $body }}

            <div class="card-footer flex flex-row flex-wrap">
                <div class="w-full text-end">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
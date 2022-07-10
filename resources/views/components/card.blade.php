@props([
    'id' => '',
    'url' => '#',
    'class' => 'w-full sm:w-1/2 md:w-1/3 p-3 sm:px-2 md:px-4',
    ])

    <div class="{{ $class }}" id="{{ $id }}">
        <div class="max-w-sm card-bg relative">
            <div class="py-2"></div>
            <h5
                class="py-1 pl-3 ltr:border-l-4 rtl:border-r-4 border-cyan-600 hover:border-cyan-800 transition mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white ">
                <a href="{{ $url }}" class="">
                    {{ $title }}
                </a>
            </h5>
            <div class="p-3">
                {{ $body }}

                <div class="card-footer flex flex-row flex-wrap">
                    <div class="w-full text-end">
                        {{ $footer }}
                    </div>
                </div>
            </div>
        </div>
    </div>
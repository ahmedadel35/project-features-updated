@props([
    'id' => '',
    'url' => '#',
    'class' => 'w-full sm:w-1/2 lg:w-1/3 p-3 sm:px-2 md:px-4',
    ])

    <div class="{{ $class }}" id="{{ $id }}">
        <div class="relative max-w-sm card-bg">
            <div class="py-3"></div>
            <h5
                class="py-1 mb-2 text-2xl font-bold tracking-tight text-gray-900 transition ltr:pl-3 rtl:pr-3 ltr:border-l-4 rtl:border-r-4 border-cyan-600 hover:border-cyan-800 dark:text-white ">
                <a href="{{ $url }}" class="">
                    {{ $title }}
                </a>
            </h5>
            <div class="p-3">
                {{ $body }}

                <div class="flex flex-row flex-wrap card-footer">
                    <div class="w-full text-end">
                        {{ $footer }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<section class="bg-white dark:bg-gray-900">
    <div
        class="items-center max-w-screen-xl px-4 py-8 mx-auto lg:grid lg:grid-cols-4 lg:gap-16 xl:gap-24 lg:py-24 lg:px-6">
        <div class="col-span-2 mb-8">
            <p class="text-lg font-medium text-blue-600 dark:text-blue-500">
                {{ __('home.trusted') }}
            </p>
            <h2 class="mt-3 mb-4 text-3xl font-extrabold tracking-tight text-gray-900 md:text-3xl dark:text-white">
                {{ __('home.trusted_by') }}
            </h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                {{ __('home.subTxt') }}
            </p>
            <div class="pt-6 mt-6 space-y-4 border-t border-gray-200 dark:border-gray-700">
                <div>
                    <a href="javascript:0"
                        class="inline-flex items-center text-base font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        <span class="mx-1">{{ __('home.legal') }}</span>
                        <x-fas-arrow-right class="translate rtl:rotate-180" />
                    </a>
                </div>
                <div>
                    <a href="javascript:0"
                        class="inline-flex items-center text-base font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                        <span class="mx-1">{{ __('home.trust') }}</span>
                        <x-fas-arrow-right class="translate rtl:rotate-180" />
                    </a>
                </div>
            </div>
        </div>
        <div class="col-span-2 space-y-8 md:grid md:grid-cols-2 md:gap-12 md:space-y-0">
            @php
                $stats = [
                    [
                        'title' => 'uptime',
                        'icon' => '<path fill-rule="evenodd"
                        d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm14 1a1 1 0 11-2 0 1 1 0 012 0zM2 13a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2zm14 1a1 1 0 11-2 0 1 1 0 012 0z"
                        clip-rule="evenodd"></path>',
                    ],
                    [
                        'title' => 'users',
                        'icon' => '<path
                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                    </path>',
                    ],
                    [
                        'title' => 'projects',
                        'icon' => '<path d="M320 336c0 8.844-7.156 16-16 16h-96C199.2 352 192 344.8 192 336V288H0v144C0 457.6 22.41 480 48 480h416c25.59 0 48-22.41 48-48V288h-192V336zM464 96H384V48C384 22.41 361.6 0 336 0h-160C150.4 0 128 22.41 128 48V96H48C22.41 96 0 118.4 0 144V256h512V144C512 118.4 489.6 96 464 96zM336 96h-160V48h160V96z"></path>',
                    ],
                    [
                        'title' => 'tasks',
                        'icon' => '<path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z"
                        clip-rule="evenodd"></path>',
                    ],
                ];
            @endphp

            @foreach ($stats as $st)
                <div class="capitalize">
                    <svg class="w-10 h-10 mb-2 text-blue-600 md:w-12 md:h-12 dark:text-blue-500" fill="currentColor"
                        @if ($st['title'] === 'projects') viewBox="0 0 512 512" @else viewBox="0 0 20 20" @endif
                        xmlns="http://www.w3.org/2000/svg">
                        {!! $st['icon'] !!}
                    </svg>
                    <h3 class="mb-2 text-2xl font-bold dark:text-white">
                        {{ __('home.' . $st['title']) }}
                    </h3>
                    <p class="font-light text-gray-500 dark:text-gray-400">
                        {{ __('home.' . $st['title'] . '_txt') }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@props([
    'id' => 'modalOpen',
    'title',
    'event',
    'action',
    ])

    <div x-on:{{ $event }}.window="{{ $action }}" x-show="{{ $id }}" class="fixed inset-0 z-50 overflow-y-auto modal"
        aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0" x-cloak>
            <div x-cloak x-on:click="{{ $id }} = false" x-show="{{ $id }}"
                x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

            <div x-cloak x-show="{{ $id }}" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl card-bg">
                <div class="flex items-center justify-between space-x-4">
                    <h1 class="text-xl font-medium ">
                        {{ $title }}
                    </h1>

                    <button x-on:click="{{ $id }} = false" class="transition duration-200 transform hover:scale-110">
                        <x-fas-times-circle />
                    </button>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
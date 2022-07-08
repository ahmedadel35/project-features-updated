<x-app-layout>
    <x-slot name='header'>
        <div class="flex flex-wrap flex-row justify-between">
            <div class="my-2">
                <x-breadcrump :links="[
                        [
                            'url' => route('categories.index'),
                            'name' => 'categories',
                        ],
                        [
                                    'url' => '#',
                                    'name' => $category->title,
                        ],
                    ]" current='projects' />
            </div>
            <div class="my-2">
                {{-- modal toggle --}}
                <button class="btn blue" x-data x-on:click.prevent="$dispatch('category-modal', {
                        editMode: false,
                        slug: '',
                        name: '',
                        desc: '',
                    })">
                    <x-fas-plus />
                    Create
                </button>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-row flex-wrap">
        <div class="w-full md:w-2/3 flex flex-row flex-wrap">
            @foreach($projects as $p)
                <x-card :id='$p->slug' class="w-full sm:w-1/2 lg:w-1/3 p-3 sm:px-2 md:px-4">
                    <x-slot name='title'>
                        {{ $p->name }}
                    </x-slot>

                    <x-slot name='body'>
                        <div class="p-2 text-blue-600 dark:text-blue-400 rounded font-semibold">
                            {{ numfmt_format_currency(numfmt_create( 'usd', NumberFormatter::CURRENCY ), $p->cost, 'USD') }}
                        </div>

                        @if($p->completed)
                            <div
                                class="absolute top-0 ltr:right-0 rtl:left-0 rounded px-2 py-1 bg-green-800 dark:bg-green-600 text-white !bg-opacity-75">
                                {{ __('project.completed') }}
                            </div>
                        @endif

                        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                            {{ $p->info }}
                        </p>
                    </x-slot>

                    <x-slot name='footer'>
                        <button class="btn cyan">
                            Edit
                        </button>
                        <button class="btn red">
                            Delete
                        </button>
                    </x-slot>
                </x-card>
            @endforeach
        </div>
        <div class="w-full md:w-1/3">
            <div class="my-2 flex justify-center">
                <x-card :id="$category->slug" class="w-full">
                    <x-slot name='title'>
                        {{ $category->title }}
                    </x-slot>

                    <x-slot name='body'>
                        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                            {{ $category->description }}
                        </p>
                    </x-slot>

                    <x-slot name='footer'>
                        @include('category.index.delete', [
                        'cat' => $category,
                        'to' => route('categories.index')
                        ])
                    </x-slot>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
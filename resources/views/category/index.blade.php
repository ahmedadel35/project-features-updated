<x-app-layout>
    <x-slot name='header'>
        <div class="flex flex-row flex-wrap justify-between">
            <div class="my-2">
                <x-breadcrump current='categories' />
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
        @foreach($categories as $cat)
            <x-card :id="$cat->slug" :url="route('categories.show', $cat->slug)">
                <x-slot name='title'>
                    {{ $cat->title }}
                </x-slot>

                <x-slot name='body'>
                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                        {{ $cat->description }}
                    </p>
                    <div class="px-2 py-4 text-blue-600 rounded dark:text-blue-400">
                        Projects: {{ $cat->projects_count }}
                    </div>
                </x-slot>

                <x-slot name='footer'>
                    <button class="btn cyan" x-data type="button" x-on:click.prevent="$dispatch('category-modal', {
                    editMode: true,
                    slug: '{{ $cat->slug }}',
                    name: '{{ $cat->title }}',
                    desc: '{{ $cat->description }}',
                })">
                        <x-fas-pencil />
                        {{ __('category.edit') }}
                    </button>
                    <x-btn-delete :url="route('categories.destroy', $cat->slug)" :id="$cat->slug" />
                </x-slot>
            </x-card>
        @endforeach

        <div class="py-5">
            {{ $categories->links() }}
        </div>
    </div>

    {{-- create modal --}}
    @include('category.create')
</x-app-layout>
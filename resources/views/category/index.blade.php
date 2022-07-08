<x-app-layout>
    <x-slot name='header'>
        <div class="flex flex-wrap flex-row justify-between">
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
            <div class="w-full sm:w-1/2 md:w-1/3 p-3 sm:px-2 md:px-4" id="{{$cat->slug}}">
                <div class="p-3 max-w-sm card-bg">
                    <a href="{{ route('categories.show', $cat->slug) }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $cat->title }}
                        </h5>
                    </a>
                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                        {{ $cat->description }}
                    </p>
                    <div class="px-2 py-4 text-blue-600 dark:text-blue-400 rounded">
                        Projects: {{ $cat->projects_count }}
                    </div>
                    <div class="card-footer flex flex-row flex-wrap">
                        <div class="w-full text-end">
                            <button class="btn cyan" x-data type="button" x-on:click.prevent="$dispatch('category-modal', {
                                editMode: true,
                                slug: '{{$cat->slug}}',
                                name: '{{$cat->title}}',
                                desc: '{{$cat->description}}',
                            })">
                                <x-fas-pencil />
                                {{__('category.edit')}}
                            </button>
                            @include('category.index.delete')
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- create modal --}}
    @include('category.create')
</x-app-layout>
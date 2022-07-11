<x-card :id="$cat->slug" :url="route('categories.show', $cat->slug)" class="w-full {{$class ?? 'sm:w-1/2 md:w-1/3 p-3 sm:px-2 md:px-4'}}">
    <x-slot name='title'>
        {{ $cat->title }}
    </x-slot>

    <x-slot name='body'>
        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
            {{ $cat->description }}
        </p>
        <div class="px-2 py-4 text-blue-600 rounded dark:text-blue-400">
            {{__('category.projects')}}: {{ $cat->projects_count }}
        </div>
    </x-slot>

    <x-slot name='footer'>
        @isset($canEdit)
        <button class="btn cyan" x-data type="button" x-on:click.prevent="$dispatch('category-modal', {
            editMode: true,
            slug: '{{ $cat->slug }}',
            name: '{{ $cat->title }}',
            desc: '{{ $cat->description }}',
        })">
                <x-fas-pencil />
                {{ __('category.edit') }}
            </button>
        @endisset
        <x-btn-delete :url="route('categories.destroy', $cat->slug)" :id="$cat->slug" />
    </x-slot>
</x-card>
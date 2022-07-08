<x-app-layout>
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
</x-app-layout>
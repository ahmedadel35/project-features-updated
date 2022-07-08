<x-app-layout>
    <div class="flex justify-center my-2">
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
                <x-btn-delete :url="route('categories.destroy', $category->slug)" :to="route('categories.index')" :id="$category->slug" />
            </x-slot>
        </x-card>
    </div>
</x-app-layout>
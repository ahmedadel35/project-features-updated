<x-app-layout>
    <div class="flex flex-row flex-wrap">
        <div class="w-full md:w-2/3 flex flex-row flex-wrap">
            @foreach($projects as $p)
                <x-card :id='$p->slug'>
                    <x-slot name='title'>
                        {{ $p->name }}
                    </x-slot>

                    <x-slot name='body'>

                    </x-slot>

                    <x-slot name='footer'>

                    </x-slot>
                </x-card>
            @endforeach
        </div>
        <div class="w-full md:w-1/3">
            <div class="my-2 flex justify-center">
                <x-card :id="$category->slug" :url="route('categories.show', $category->slug)" class="w-full">
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
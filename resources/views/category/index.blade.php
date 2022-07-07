<x-app-layout>
    <div class="flex flex-row flex-wrap">
        @foreach($categories as $cat)
            <div class="w-full sm:w-1/2 md:w-1/3 p-3 sm:px-2 md:px-4">
                <div class="p-3 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 transition duration-200"
                    id="cat{{ $cat->slug }}">
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
                        <div class="w-0 md:w-1/3"></div>
                        <div class="w-full md:w-2/3">
                            <button class="btn cyan" type="button">
                                <x-fas-pencil />
                                Edit
                            </button>
                            <form class="inline-block"
                                action="{{ route('categories.destroy', $cat->slug) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <x-btn-with-spinner class="red" type="submit" icon='fas-trash' desc='delete category {{$cat->slug}}'>
                                    Delete
                                </x-btn-with-spinner>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
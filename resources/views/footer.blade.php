<footer class="p-4 bg-white sm:p-6 dark:bg-gray-900">
    <div class="md:flex md:justify-between">
        <div class="mb-6 md:mb-0">
            <a href="/" class="flex items-center">
                <x-application-logo class="mr-3 h-9 dark:text-white" />
                <span
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ env('APP_NAME') }}</span>
            </a>
        </div>
        <div class="grid grid-cols-2 gap-8">
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    {{ __('nav.Sections') }}
                </h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="mb-4">
                        <a href="{{ route('categories.index') }}" class="hover:underline">
                            {{ __('nav.categories') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index', 'all') }}" class="hover:underline">
                            {{ __('nav.projects') }}
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">
                    {{ __('nav.ProjectRepo') }}
                </h2>
                <ul class="text-gray-600 dark:text-gray-400">
                    <li class="mb-4">
                        <a target="_blank" href="https://github.com/themesberg/flowbite" class="hover:underline ">
                            {{ __('auth.github') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8">
    <div class="sm:flex sm:items-center sm:justify-between">
        <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400" dir="ltr">© 2022 @if (date('Y') !== '2022')
                - {{ date('Y') }}
            @endif Made with <span class="text-red-600 dark:text-red-500">
                &hearts;</span> by <a href="https://abo3adel.github.io/" class="hover:underline"
                target="_blank">Ahmed Adel</a>.
        </span>
        @include('footer.social')
    </div>
</footer>

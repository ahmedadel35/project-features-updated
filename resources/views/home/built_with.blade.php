<section class="bg-gray-50 dark:bg-gray-800">
    <div class="max-w-screen-xl px-4 py-8 mx-auto space-y-12 lg:space-y-20 lg:py-24 lg:px-6">

        <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
            <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    {{ __('home.tools') }}
                </h2>
                <p class="mb-8 font-light lg:text-xl">
                    {{ __('home.txt') }}
                </p>

                <ul role="list" class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
                    @php
                        $tools = ['PHP', 'Laravel', 'PHP unit', 'AlpineJs', 'Tailwindcss'];
                    @endphp

                    @foreach ($tools as $t)
                        <li class="flex space-x-3">

                            <svg class="flex-shrink-0 w-5 h-5 text-blue-500 dark:text-blue-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 uppercase dark:text-white">
                                {{ $t }}
                            </span>
                        </li>
                    @endforeach
                </ul>
                <p class="mb-8 font-light lg:text-xl">
                    {{ __('home.subTxt') }}
                </p>
            </div>
            <div class="w-full h-full">
                <x-img-loader
                    src='https://www.mytechlogy.com/upload/by_users/paulcook/221709043957WhyLaravelisaSoughtafterPHPFrameworkamongEnterprises.jpg'
                    alt='tools feature image' class="hidden w-full mb-4 lg:mb-0 lg:flex" />
            </div>
        </div>

        <div class="items-center gap-8 lg:grid lg:grid-cols-2 xl:gap-16">
            <div class="flex flex-row w-full mb-4 lg:mb-0 lg:flex">
                <x-img-loader src='/shots/3.jpeg' alt='projects index' />
                <x-img-loader src='/shots/4.jpeg' alt='tasks index' />
            </div>
            <div class="text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                    {{ __('home.features') }}
                </h2>
                <p class="mb-8 font-light lg:text-xl">
                    {{ __('home.txt') }}
                </p>

                <ul role="list" class="pt-8 space-y-5 border-t border-gray-200 my-7 dark:border-gray-700">
                    @php
                        $features = [__('home.feat.category'), __('home.feat.tasks'), __('home.feat.project_teams'), __('home.feat.real_time')];
                    @endphp

                    @foreach ($features as $feat)
                        <li class="flex space-x-3">

                            <svg class="flex-shrink-0 w-5 h-5 text-blue-500 dark:text-blue-400" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base font-medium leading-tight text-gray-900 dark:text-white">
                                {{ $feat }}
                            </span>
                        </li>
                    @endforeach
                </ul>
                <p class="font-light lg:text-xl">
                    {{ __('home.subTxt') }}
                </p>
            </div>
        </div>
    </div>
</section>

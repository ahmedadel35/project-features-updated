<section class="pt-10 text-white border-gray-200 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 dark:from-gray-800 dark:via-gray-700 dark:to-gray-900 md:pt-0">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
                {{__('home.hero_title')}}
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                {{__('home.hero_txt')}}
            </p>
            <x-btn-with-spinner :title="__('home.get_started')" :href="route('projects.index', 'all')" tag='a' desc='get started' class="my-1 lg">
                <span class="mx-2">
                    {{__('home.get_started')}}
                </span>
                <x-fas-arrow-right class="translate rtl:rotate-180" />
            </x-btn-with-spinner>
            <a title="__('auth.github')" href="https://github.com/abo3adel/project-features-updated" target="_blank"  aria-describedby='view on github' class="my-1 btn lg github">
                <x-fab-github />
                {{__('home.view_on')}} {{__('auth.github')}}
            </a> 
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <x-img-loader src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="app hero image">
        </div>                
    </div>
</section>
<section class="bg-gradient-to-r from-blue-600 via-blue-500 to-blue-700 text-white border-gray-200 dark:from-gray-800 dark:via-gray-700 dark:to-gray-900 pt-10 md:pt-0">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                {{__('home.hero_title')}}
            </h1>
            <p class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                {{-- todo add predifined text here --}}
                {{fake(app()->getLocale() === 'ar' ? 'ar_SA' : 'en_US')->realText()}}
            </p>
            <x-btn-with-spinner :title="__('home.getStarted')" :href="route('projects.index', 'all')" tag='a' desc='get started' class="lg my-1">
                <span class="mx-2">
                    {{__('home.getStarted')}}
                </span>
                <x-fas-arrow-right class="translate rtr:rotate-180" />
            </x-btn-with-spinner>
            <a title="__('auth.github')" href="https://github.com/abo3adel/project-features-updated" target="_blank"  aria-describedby='view on github' class="btn lg github my-1">
                <x-fab-github />
                {{__('home.viewOn')}} {{__('auth.github')}}
            </a> 
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
        </div>                
    </div>
</section>
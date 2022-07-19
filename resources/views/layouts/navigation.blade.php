<nav class="nav-bg px-2 sm:px-4 py-2.5 rounded w-full fixed top-0 z-50" x-data="{
    size: 320,
    navMenuOpen: false,
    initate: function() {
        this.size = window.innerWidth;

        if (this.size >= 768) {
            this.navMenuOpen = true;
        }
    },
}" x-init="initate">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="/" class="flex items-center">
            <x-application-logo class="h-5 sm:h-7" alt="{{ env('APP_NAME', 'website') }} Logo" />
            <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white">
                {{ env('APP_NAME', '') }}
            </span>
        </a>
        <div class="flex items-center md:order-2">
            <x-theme-toggle />
            {{-- language dropdown --}}
            <x-dropdown>
                <x-slot name="trigger">
                    <button type="button" class="flex mx-1 text-sm" id="lang-menu-button" aria-expanded="false"
                        data-dropdown-toggle="dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open lang menu</span>
                        <x-fas-language class="!w-7 !h-7 !m-0" />
                    </button>
                </x-slot>

                <x-slot name='content'>
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <x-dropdown-link rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ app()->getLocale() == $localeCode ? 'javascript:void' : LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            :active="app()->getLocale() == $localeCode">
                            {{ $properties['native'] }}
                        </x-dropdown-link>
                    @endforeach


                </x-slot>
            </x-dropdown>
            {{-- user dropdown --}}

            <x-dropdown>
                <x-slot name="trigger">
                    <button type="button"
                        class="flex text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown"
                        data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        @auth
                            <x-avatar :src="Auth::user()->avatar" :title="Auth::user()->name" alt="user avatar" />
                        @else
                            <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </div>
                        @endauth
                    </button>
                </x-slot>

                <x-slot name='content'>
                    @auth
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span
                                class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <x-dropdown-link href="{{ route('change-password.create') }}"
                            aria-describedby="change user pasword">
                            {{ __('auth.change_password') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    @else
                        <x-dropdown-link href="{{ route('login') }}" aria-describedby="login to enter app"
                            :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="{{ route('register') }}" aria-describedby="register user"
                            :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    @endauth
                </x-slot>
            </x-dropdown>
            {{-- main menu toggler --}}
            <button x-on:click.prevent="navMenuOpen = !navMenuOpen" type="button"
                class="inline-flex items-center p-2 ml-1 text-sm text-gray-200 rounded-lg md:hidden hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div x-show="navMenuOpen" class="items-center justify-between w-full md:flex md:w-auto md:order-1"
            id="mobile-menu-2" x-cloak x-transition>
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                <li>
                    <x-nav-link :active="request()->routeIs('categories.index')" href="{{ route('categories.index') }}">
                        {{ __('nav.categories') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-dropdown>
                        <x-slot name='trigger'>
                            <x-nav-link :active="request()->routeIs('projects.index*')" href="#">
                                {{ __('nav.projects') }}
                            </x-nav-link>
                        </x-slot>

                        <x-slot name='content'>
                            <x-dropdown-link href="{{ route('projects.index', \App\Enums\ProjectTab::All->value) }}"
                                :active="Route::current()->parameter('project_tab') === \App\Enums\ProjectTab::All">
                                {{ __('project.tabs.all') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('projects.index', \App\Enums\ProjectTab::Mine->value) }}"
                                :active="Route::current()->parameter('project_tab') === \App\Enums\ProjectTab::Mine">
                                {{ __('project.tabs.mine') }}
                            </x-dropdown-link>

                            <x-dropdown-link
                                href="{{ route('projects.index', \App\Enums\ProjectTab::Invited->value) }}"
                                :active="Route::current()->parameter('project_tab') ===
                                    \App\Enums\ProjectTab::Invited">
                                {{ __('project.tabs.invited') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </li>
            </ul>
        </div>
    </div>
</nav>

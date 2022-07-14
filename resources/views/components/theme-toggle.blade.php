<div class='flex w-8 h-8' x-data>
    <button type='button' x-on:click.prevent="$store.common.toggleDark()" x-init="$store.common.setDarkMode($store.common.dark)"
        class='focus:outline-none relative overflow-hidden' aria-label="Toggle theme">
        <svg class="w-full h-full fill-yellow-300" x-show="$store.common.dark" aria-label="Apply light theme"
            fill="currentColor" viewBox="0 0 20 20" x-cloak x-transition>
            <path fill-rule="evenodd"
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                clip-rule="evenodd"></path>
        </svg>
        <svg class="w-full h-full fill-orange-600" x-show="!$store.common.dark" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"
        stroke-linejoin="round" x-cloak x-transition>
        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" /></svg>

    </button>
</div>
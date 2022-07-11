<div class="flex flex-col flex-wrap sm:flex-row sm:justify-between items-center">
    <div class="my-1 flex flex-row flex-wrap justify-between items-center" x-data="{
            state: {{ request()->has('filter.completed') ? (request()->get('filter')['completed'] === 'true' ? 2 : 3) : 1 }},
            setState: function() {
                let queryParams = new URLSearchParams(window.location.search);  
                if (this.state == 1) {
                    {{-- set to all --}}
                    queryParams.delete('filter[completed]')
                } else if( this.state == 2) {
                    {{-- set to only completed --}}
                    queryParams.set('filter[completed]', true)
                } else {
                    {{-- not completed --}}
                    queryParams.set('filter[completed]', false)
                }

                window.location.search = queryParams.toString();
            },
        }">
        <label for="project-state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 px-1"
            aria-describedby="select state">
            <span class="w-5">
                <x-fas-list-check />
            </span>
            <span class="hidden md:inline-block">
                {{ __('project.filter.set_state') }}
            </span>
        </label>
        <select id="project-state" x-on:change.prevent="setState" x-model="state"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="1">{{ __('project.filter.state_all') }}</option>
            <option value="2">{{ __('project.filter.state_comp') }}</option>
            <option value="3">{{ __('project.filter.state_non_comp') }}</option>
        </select>
    </div>
    <div class="my-1 flex flex-row flex-wrap justify-between items-center" x-data="{
        active: {
            value: '-updated_at',
            name: '{{ __('project.filter.sort.updated_desc') }}',
            icon: 'up',
        },
        options: [
            {
                value: 'name',
                name: '{{ __('project.filter.sort.name_asc') }}',
                icon: 'down',
            },
            {
                value: '-name',
                name: '{{ __('project.filter.sort.name_desc') }}',
                icon: 'up',
            },
            {
                value: 'cost',
                name: '{{ __('project.filter.sort.cost_asc') }}',
                icon: 'down',
            },
            {
                value: '-cost',
                name: '{{ __('project.filter.sort.cost_desc') }}',
                icon: 'up',
            },
            {
                value: 'updated_at',
                name: '{{ __('project.filter.sort.updated_asc') }}',
                icon: 'down',
            },
            {
                value: '-updated_at',
                name: '{{ __('project.filter.sort.updated_desc') }}',
                icon: 'up',
            },
        ],
        sortBy: function(opt) {
            this.active = opt;
            const queryParams = new URLSearchParams(window.location.search);  
            queryParams.set('sort', opt.value)
            window.location.search = queryParams.toString();
        },
        setSortOnInit: function() {
            const queryParams = new URLSearchParams(window.location.search);  
            if (!queryParams.has('sort')) return;

            const val = queryParams.get('sort')
            for (let opt of this.options) {
                if (opt.value === val) {
                    this.active = opt;
                    break;
                }
            }
        },
    }" x-init="setSortOnInit">
        <div class="px-1">
            <span class="w-5">
                <x-fas-filter />
            </span>
            <span class="hidden md:inline-block">
                {{ __('project.filter.sort.by') }}
            </span>
        </div>
        <div>
            <x-dropdown>
                <x-slot name='trigger'>
                    <button class="btn purple">
                        <span class="w-5">
                            <template x-if="active.icon === 'up'">
                                <x-fas-arrow-up-9-1 />
                            </template>
                            <template x-if="active.icon === 'down'">
                                <x-fas-arrow-down-1-9 />
                            </template>
                        </span>
                        <span x-text="active.name"></span>
                    </button>
                </x-slot>

                <x-slot name='content'>
                    <template x-for="opt in options" :key="opt.value">
                        <x-dropdown-link href='#' x-on:click.prevent="sortBy(opt)"
                            x-bind:class="{'active': active === opt}">
                            <span class="w-5">
                                <template x-if="opt.icon === 'up'">
                                    <x-fas-arrow-up-9-1 />
                                </template>
                                <template x-if="opt.icon === 'down'">
                                    <x-fas-arrow-down-1-9 />
                                </template>
                            </span>
                            <span x-text="opt.name"></span>
                        </x-dropdown-link>
                    </template>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</div>
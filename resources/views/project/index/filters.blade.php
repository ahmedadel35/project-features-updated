<div class="flex flex-col flex-wrap md:flex-row md:justify-between items-center">
    <div class="items-center my-1 flex flex-row flex-wrap justify-between" x-data="{
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
        <label for="project-state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 px-1">
            Select state
        </label>
        <select id="project-state" x-on:change.prevent="setState" x-model="state"
            class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="1">All</option>
            <option value="2">Completed</option>
            <option value="3">Not Completed</option>
        </select>
    </div>
    <div class="my-1 flex flex-row flex-wrap justify-between items-center" x-data="{
        active: {
            value: '-created_at',
            name: 'created at DESC',
            icon: 'up',
        },
        options: [
            {
                value: 'name',
                name: 'Name ASC',
                icon: 'down',
            },
            {
                value: '-name',
                name: 'Name DESC',
                icon: 'up',
            },
            {
                value: 'cost',
                name: 'Cost ASC',
                icon: 'down',
            },
            {
                value: '-cost',
                name: 'Cost DESC',
                icon: 'up',
            },
            {
                value: 'updated_at',
                name: 'created at ASC',
                icon: 'down',
            },
            {
                value: '-updated_at',
                name: 'created at DESC',
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
            sort by
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
                        <x-dropdown-link href='#' x-on:click.prevent="sortBy(opt)" x-bind:class="{'active': active === opt}">
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
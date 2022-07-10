<div class="flex flex-col flex-wrap md:flex-row md:justify-between">
    <div class="my-1">
        <div class="flex flex-row flex-wrap justify-between" x-data="{
            state: {{request()->has('filter.completed') ? (request()->get('filter')['completed'] === 'true' ? 2 : 3) : 1}},
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
            <label for="project-state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                Select state
            </label>
            <select id="project-state" x-on:change.prevent="setState" x-model="state"
                class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1">All</option>
                <option value="2">Completed</option>
                <option value="3">Not Completed</option>
            </select>
        </div>
    </div>
    <div class="my-1"></div>
</div>
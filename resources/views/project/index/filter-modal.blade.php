<div x-data="{
    size: 320, // mobile first,
    opend: false,
    initate: function() {
        this.size = window.innerWidth;

        if (this.size >= 768) {
            this.opend = true;
        }
    },
}" x-init="initate" x-cloak x-on:filter-modal.window="opend = true">
    <div x-bind:class="{
        'fixed inset-0 z-50 flex items-center justify-center w-full h-full overflow-y-auto bg-gray-900 bg-opacity-10': size <
            768
    }"
        x-show="opend">
        <div x-bind:class="{
            'inline-block w-full max-w-xl p-8 my-20 overflow-x-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl card-bg h-1/2': size <
                768
        }"
            x-show="opend" x-transition x-on:click.outside="opend = false">
            <div class="flex items-center justify-between mb-3 space-x-4 md:hidden">
                <h1 class="text-xl font-medium ">
                    {{ __('project.filter') }}
                </h1>

                <button x-on:click="opend = false" class="transition duration-200 transform hover:scale-110">
                    <x-fas-times-circle />
                </button>
            </div>
            <hr class='hidden my-3 border border-gray-600 md:block dark:border-gray-300' />
            @include('project.index.filters')

            {{-- tabs --}}
            @includeWhen($category === null, 'project.index.tabs')
        </div>
    </div>
</div>

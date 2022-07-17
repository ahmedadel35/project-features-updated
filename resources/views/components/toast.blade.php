<div x-data="{
    notices: [],
    add(notice) {
        notice.id = Date.now();
        this.notices.push(notice);

        const timeShown = 2000 * this.notices.length;
        setTimeout(() => {
            this.remove(notice.id);
        }, timeShown)
    },
    remove(id) {
        this.notices.splice(this.notices.findIndex(notice => notice.id == id), 1);
    },
}">
    <div class="fixed bottom-5 p-3 toast-container ltr:right-5 rtl:left-5" x-on:toast.window="add($event.detail)" @if(session('notify'))
        x-init="add({
            type: 'info',
            text: '{{__('auth.notify')}}',
            info: '{{session('notify')}}',
        })"
    @endif>
        <template x-for="notice of notices" :key="notice.id">
            <div id="toast-notification"
                class="p-2 w-full max-w-xs text-gray-900 bg-white rounded-lg shadow dark:bg-gray-800 dark:text-gray-300 cursor-pointer mb-2"
                role="alert">
                <div class="flex items-center relative" x-on:click.prevent="remove(notice.id)">
                    <div class="inline-block relative shrink-0 text-white">
                        <template x-if="notice.img">
                            <div>
                                <img class="w-12 h-12 rounded-full" x-bind:src="notice.img"
                                    alt="user profile image" />
                                <span
                                    class="inline-flex absolute right-0 bottom-0 justify-center items-center w-6 h-6 bg-blue-600 rounded-full">
                                    <x-fas-fire class="!w-4 !h-4 !m-0" />
                                </span>
                            </div>
                        </template>

                        <template x-if="!notice.img">
                            <div class="inline-flex flex-shrink-0 justify-center items-center w-8 h-8  rounded-lg has-gr"
                                x-bind:class="{
                                    'green': notice.type === 'success',
                                    'red': notice.type === 'error',
                                    'lime': notice.type === 'warning',
                                    'cyan': notice.type === 'info',
                                }">
                                <template x-if="notice.type === 'success'">
                                    <x-fas-check class="!w-4 !h-4 !m-0" />
                                </template>
                                <template x-if="notice.type !== 'success'">
                                    <x-fas-times class="!w-4 !h-4 !m-0" />
                                </template>
                            </div>
                        </template>
                    </div>
                    <div class="ml-3 text-sm font-normal">
                        <h4 class="text-sm font-semibold" x-bind:class="{
                            'text-green-600 dark:text-green-500': notice.type === 'success',
                            'text-red-600 dark:text-red-500': notice.type === 'error',
                            'text-orange-600 dark:text-orange-500': notice.type === 'warning',
                            'text-cyan-600 dark:text-cyan-500': notice.type === 'info',
                        }" x-text="notice.text"></h4>
                        <div class="text-sm font-normal text-gray-600 dark:text-gray-400" x-text="notice.info">
                        </div>
                        <span class="text-xs font-medium text-blue-600 dark:text-blue-500">
                            {{__('nav.few_ago')}}
                        </span>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
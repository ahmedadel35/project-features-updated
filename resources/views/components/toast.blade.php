<div x-data="{
    notices: [],
    visible: [],
    add(notice) {
        notice.id = Date.now()
        if (notice.type === 'error') {
            notice.text = '😵 ' + notice.text
        }else if (notice.type === 'warning') {
            notice.text = '⚡ ' + notice.text
        }else if (notice.type === 'info') {
            notice.text = '🔥 ' + notice.text
        }else {
            notice.text = '🔥 ' + notice.text
        }
        this.notices.push(notice)
        this.fire(notice.id)
    },
    fire(id) {
        this.visible.push(this.notices.find(notice => notice.id == id))
        const timeShown = 2000 * this.visible.length
        setTimeout(() => {
            this.remove(id)
        }, timeShown)
    },
    remove(id) {
        this.visible.splice(this.visible.findIndex(notice => notice.id == id), 1)
    },
}">
<div class="fixed bottom-0 p-3 toast-container ltr:right-0 rtl:left-0" x-on:toast.window="add($event.detail)">
    <template x-for="notice of notices" :key="notice.id">
        <div class="flex items-center w-full max-w-xs px-2 py-3 my-3 text-white rounded-lg shadow" role="alert" x-show="visible.includes(notice)" x-bind:class="{
            'bg-green-600': notice.type === 'success',
            'bg-blue-600': notice.type === 'info',
            'bg-orange-600': notice.type === 'warning',
            'bg-red-600': notice.type === 'error',
        }">
            <div class="text-sm font-normal ltr:mr-3 rtl:ml-3" x-text="notice.text"></div>
            <button type="button" class="inline-flex items-center justify-center w-8 h-8 p-0 text-center text-white bg-red-600 rounded-lg bg-opacity-80 focus:ring-2 focus:ring-red-300 hover:bg-opacity-100 focus:outline-none" aria-label="Close" x-on:click.prevent="remove(notice.id)">
                <span class="sr-only" >Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </template>
 </div>
</div>

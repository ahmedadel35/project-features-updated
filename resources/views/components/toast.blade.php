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
        console.log(id);
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
<div class="toast-container fixed bottom-0 ltr:right-0 rtl:left-0 p-3" x-on:toast.window="add($event.detail)">
    <template x-for="notice of notices" :key="notice.id">
        <div class="flex items-center w-full max-w-xs px-2 py-3 text-white  rounded-lg shadow  my-3" role="alert" x-show="visible.includes(notice)" x-bind:class="{
            'bg-green-600': notice.type === 'success',
            'bg-blue-600': notice.type === 'info',
            'bg-orange-600': notice.type === 'warning',
            'bg-red-600': notice.type === 'error',
        }">
            <div class="ltr:mr-3 rtl:ml-3 text-sm font-normal" x-text="notice.text"></div>
            <button type="button" class="text-center justify-center items-center bg-red-600 bg-opacity-80 text-white  rounded-lg focus:ring-2 focus:ring-red-300 p-0 hover:bg-opacity-100 inline-flex h-8 w-8 focus:outline-none" aria-label="Close" x-on:click.prevent="remove(notice.id)">
                <span class="sr-only" >Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </template>
 </div>
</div>

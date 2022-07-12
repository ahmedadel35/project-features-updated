<div class="w-full px-2 pt-4 mx-2 my-2 card-bg" x-data="{
    body: '',
    bodyErr: '',
    saving: false,
    editMode: false,
    url: '{{route('tasks.store', [$category->slug, $project->slug])}}',
    save: async function() {
        if (this.saving) return;

        if (!this.body.length) {
            this.bodyErr = true;
            return;
        };

        this.saving = true;

        const res = await axios({
            method: this.editMode ? 'put' : 'post',
            url: this.url,
            data: {
                body: this.body,
            }
        }).catch(err => {

        })

        this.saving = false;
        if (!res || res.status !== 201 || !res.data) {
            $dispatch('toast', {type: 'error', text: '{{__('category.error')}}'})
            return;
        }

        $dispatch('toast', {type: 'success', text: '{{__('task.success')}}'});
        this.body = this.bodyErr = '';

        {{-- append to tasks list as the first item--}}
        const tasksList = document.getElementById('tasks');
        tasksList.innerHTML = res.data + tasksList.innerHTML;
    },
}">
    <form method="post" x-on:submit.prevent="save" class="" novalidate>
        <div class="flex items-center justify-between w-full space-x-3">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="body" id="body" class="input-floating peer" placeholder=" "
                    x-on:keypress="bodyErr = false" x-model.trim="body" required>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    <span x-show="bodyErr === true">
                        {{ __('validation.required', ['attribute' => __('task.body')]) }}
                    </span>
                    <span x-show="typeof bodyErr === 'string' && bodyErr.length" x-text="bodyErr">
                    </span>
                </p>
                <label for="body" class="peer-focus:font-medium label-floating">
                    {{ __('task.body') }}
                </label>
            </div>
            <x-btn-with-spinner type='submit' icon='fas-save' desc='add new task' busy='saving' class='!flex items-center justify-between'>
                <span class="inline">{{ __('task.save') }}</span>
            </x-btn-with-spinner>
        </div>
    </form>
</div>

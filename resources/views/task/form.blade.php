<div class="w-full px-2 pt-4 mx-2 my-2 card-bg" x-data="{
    body: '',
    bodyErr: '',
    saving: false,
    editMode: false,
    task: {},
    url: '{{route('tasks.store', [$category->slug, $project->slug])}}',
    postUrl: '{{route('tasks.store', [$category->slug, $project->slug])}}',
    save: async function() {
        if (this.saving) return;

        if (!this.body.length) {
            this.bodyErr = true;
            return;
        };

        this.saving = true;

        const res = await axios({
            method: this.editMode ? 'put' : 'post',
            url: this.editMode ? this.url : this.postUrl,
            data: {
                body: this.body,
            }
        }).catch(err => {

        })

        this.saving = false;
        if (!res || (this.editMode && res.status !== 204)
        || (!this.editMode && res.status !== 201)
        ) {
            $dispatch('toast', {type: 'error', text: '{{__('category.error')}}'})
            return;
        }

        $dispatch('toast', {type: 'success', text: '{{__('task.success')}}'});
        
        this.task.body = this.body;
        this.body = this.bodyErr = '';

        if (this.editMode) {
            $dispatch('update-task', {task: this.task})
            this.editMode = false;
            return;
        }
        $dispatch('add-task', {task: res.data})
    },
    editTask: function(task) {
        this.editMode = true;
        this.task = task;
        this.body = task.body;
        this.bodyErr = false;

        this.url = this.postUrl + '/' + task.id
    }
}" x-on:edit-task.window="editTask($event.detail)">
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
                <span class="inline" x-show="!editMode">{{ __('task.save') }}</span>
                <span class="inline" x-show="editMode">{{ __('task.update') }}</span>
            </x-btn-with-spinner>
            <button class="btn red" x-show="editMode" x-on:click.prevent="editMode = false;body = '';task = {}" aria-describedby="cancel edit mode">
                <x-fas-times />
            </button>
        </div>
    </form>
</div>

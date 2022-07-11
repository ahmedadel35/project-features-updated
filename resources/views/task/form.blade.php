<div class="w-full px-2 pt-4 mx-2 my-2 card-bg" x-data="{
    body: '',
    bodyErr: '',
    saving: false,
    editMode: false,
    save: function() {
        
    },
}">
    <form method="post" x-on:submit.prevent="save" class="">
        <div class="flex items-center justify-between w-full space-x-3">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="body" id="body" class="input-floating peer" placeholder=" "
                    x-on:keypress="bodyErr = false" x-model.trim="body" required>
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                    @error('body')
                        {{ $message }}
                    @enderror
                    <span x-show="bodyErr">
                        {{ __('validation.required', ['attribute' => __('project.body')]) }}
                    </span>
                </p>
                <label for="body" class="peer-focus:font-medium label-floating">
                    {{ __('project.body') }}
                </label>
            </div>
            <x-btn-with-spinner type='submit' icon='fas-save' desc='add new task' busy='saving' class='!flex items-center justify-between'>
                <span class="inline">{{ __('task.save') }}</span>
            </x-btn-with-spinner>
        </div>
    </form>
</div>

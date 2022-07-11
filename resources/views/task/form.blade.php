<div class="my-2" x-data="{
    body: '',
    bodyErr: '',

}">
    <form method="post" x-on:submit.prevent="save">
        <div class="flex flex-row flex-wrap justify-between w-full">
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
            <div>
                <button class="btn pink">save</button>
            </div>
        </div>
    </form>
</div>

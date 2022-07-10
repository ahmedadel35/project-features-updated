<div x-data="{
    categoryModal: false,
    editMode: false,
    slug: '',
    name: '',
    desc: '',
    url: '{{ route("categories.store") }}',
    open: function(ev) {
        this.editMode = ev.editMode;
        this.slug = ev.slug;
        this.name = ev.name;
        this.desc = ev.desc;

        if (this.editMode) {
            this.url += '/' + this.slug;
        }

        this.categoryModal = true;
    }
}">
    <x-modal :title="__('category.add')" event="category-modal" action="open($event.detail)" id="categoryModal">
        <form class="mt-5" x-bind:action="url" method="post" x-ref='categoryForm' x-data="{
            {{-- name: '{{ old("title", null) }}', --}}
            {{-- desc: '{{ old("description", null) }}', --}}
            nameErr: false,
            descErr: false,
            saving: false, 
            save: function() {
                if (this.saving) return false;
                this.nameErr = this.descErr = false;
                if (!this.name.length) {
                    this.nameErr = true;
                }
                if (!this.desc.length) {
                    this.descErr = true;
                }
                if (this.nameErr || this.descErr) return false;
;

                this.saving = true;
                this.$refs.categoryForm.submit();
            },
        }" x-on:submit.prevent="save" novalidate>
            @if($errors->any())
                <x-alert color="red">
                    {{ __('category.error') }}
                </x-alert>
            @endif

            <template x-if='editMode'>
                @method('PUT')
            </template>

            @csrf
            <div class="flex flex-row flex-wrap">
                <label for="category-name"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 w-full md:w-1/5">{{ __('category.title') }}</label>
                <div class="relative w-full md:w-4/5">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-fas-heading class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    </div>
                    <input type="text" id="category-name" class="input" placeholder="Home" name="title" x-model='name'
                        required>
                </div>
                <div class="w-full flex">
                    <div class="md:w-1/5"></div>
                    <div>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('title')
                                {{ $message }}
                            @enderror
                            <span x-show='nameErr'>
                                {{ __('validation.required', ['attribute' => __('category.title')]) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-row flex-wrap mt-3">
                <label for="category-desc"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 w-full md:w-1/5">{{ __('category.desc') }}</label>
                <div class="relative w-full md:w-4/5">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-fas-info class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    </div>
                    <textarea type="text" id="category-desc" class="input"
                        placeholder="{{ __('category.desc_pl') }}" name="description" rows="4"
                        x-model='desc' required>
                    </textarea>
                </div>
                <div class="w-full flex">
                    <div class="md:w-1/5"></div>
                    <div>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            @error('description')
                                {{ $message }}
                            @enderror
                            <span x-show='descErr'>
                                {{ __('validation.required', ['attribute' => __('category.desc')]) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <x-btn-with-spinner icon='fas-save' type='submit' desc='save new category' busy='saving'>
                    {{ __('category.create') }}
                </x-btn-with-spinner>
            </div>
        </form>
    </x-modal>
</div>
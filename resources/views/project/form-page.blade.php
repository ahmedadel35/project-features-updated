<x-app-layout>
    <x-slot name='header'>
        <x-breadcrump :current="$title . '_project'" :links="[
            [
                'name' => 'categories',
                'url' => route('categories.index'),
            ],
            [
                'name' => $category?->title,
                'no_trans' => true,
                'url' => $category ? route('categories.show', $category->slug) : '#',
            ],
        ]" />
    </x-slot>

    <div class="relative py-10 mx-auto mt-5 card-bg md:w-4/5" x-data="{
        saving: false,
        hasCategory: {{ $category ? 1 : 0 }},
        url: '{{ $url }}',
        category: null,
        fakeSlug: '{{ $fake_slug }}',
        form: {
            name: '{{ $vals['name'] }}',
            cost: '{{ $vals['cost'] }}',
            info: '{{ $vals['info'] }}',
        },
        error: {
            name: false,
            cost: false,
            info: false
        },
        hasError: false,
        save: function() {
            if (this.saving) return false;
    
            {{-- reset --}}
            this.hasError = false;
    
            for (const inp in this.form) {
                if (!this.form[inp] || !this.form[inp].length) {
                    this.error[inp] = true;
                    this.hasError = true;
                }
            }
    
            if (this.hasError) return false;
    
            this.saving = true;
            this.$refs.projectForm.submit();
        },
        setUrl: function() {
            {{-- check if user visited this page using a category slug --}}
            if (this.hasCategory) return;
    
            {{-- replace fake-slug with slected one --}}
            this.url = this.url.replace(this.fakeSlug, this.category);
            this.fakeSlug = this.category;
        },
    }" x-init="() => document.body.classList.add('gr-bg')">
        <div class="w-full mb-4 text-center">
            <h3 class="text-3xl">
                {{ __('nav.' . $title . '_project') }}
            </h3>
        </div>
        <form x-ref='projectForm' x-on:submit.prevent="save" class="px-2 py-10 mx-auto rounded-none md:px-6"
            x-bind:action="url" method="post" novalidate>
            @csrf

            @isset($putMethod)
                @method('PUT')
            @endisset

            @if (count($categories))
                <div class="flex flex-row flex-wrap items-center justify-between mb-3">
                    <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                        {{ __('project.select_cat') }}
                    </label>
                    <select id="categories" class="" x-model="category" x-on:change.prevent="setUrl">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->slug }}">
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="grid grid-cols-1">
                <div class="relative z-0 w-full mb-6 group">

                    <input type="text" name="name" id="name"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " x-on:keypress="error.name = false" x-model.trim="form.name" required>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('name')
                            {{ $message }}
                        @enderror
                        <span x-show="error.name">
                            {{ __('validation.required', ['attribute' => __('project.name')]) }}
                        </span>
                    </p>
                    <label for="name"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('project.name') }}
                    </label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="number" min="1" max="99999.99" name="cost" id="cost"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " x-on:keypress="error.cost = false" x-model.trim="form.cost" required>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('cost')
                            {{ $message }}
                        @enderror
                        <span x-show="error.cost">
                            {{ __('validation.required', ['attribute' => __('project.cost')]) }}
                        </span>
                    </p>
                    <label for="cost"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        {{ __('project.cost') }}
                    </label>
                </div>
            </div>
            <div class="grid grid-cols-1">
                <div class="relative z-0 w-full mb-6 group">
                    <textarea name="info" id="info"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        rows="5" placeholder=" " x-on:keypress="error.info = false" x-model.trim="form.info" required></textarea>
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('info')
                            {{ $message }}
                        @enderror
                        <span x-show="error.info">
                            {{ __('validation.required', ['attribute' => __('project.info')]) }}
                        </span>
                    </p>
                    <label for="info"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75    peer-focus:-translate-y-6">
                        {{ __('project.info') }}
                    </label>
                </div>
            </div>
            <x-btn-with-spinner icon='fas-save' type='submit' desc='save new project' class='green' busy='saving'>
                {{ __('category.' . $title) }}
            </x-btn-with-spinner>
        </form>
    </div>
</x-app-layout>

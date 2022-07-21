<div class="" x-data="{
    projectModal: false,
    email: '',
    emailErr: null,
    saving: false,
    url: '',
    slug: '',
    open: function({ slug, url }) {
        {{-- console.log(slug, url) --}}
        this.email = '';
        this.emailErr = null;
        this.url = url;
        this.slug = slug;
        this.projectModal = true;
    },
    save: async function() {
        if (this.saving) return false;
        this.emailErr = '';

        if (!this.email.length || !$store.common.testMail(this.email)) {
            this.emailErr = true;
            return false;
        }

        this.saving = true;

        const res = await axios.post(this.url, { email: this.email }).catch(err => {
            {{-- console.log(err.response); --}}
            if (err.response.status === 422) {
                this.emailErr = err.response.data.message;
            }
        });

        this.saving = false;
        if (!res || !res.data || !res.data.blade) {
            $dispatch('toast', { type: 'error', text: '{{ __('category.erorr') }}' });
            return;
        }

        {{-- add newly added user avatar next to the rest of the team members --}}
        const teamImagesContainer = document.querySelector('#' + this.slug + '-team');
        teamImagesContainer.innerHTML += res.data.blade;
        this.projectModal = false;

        $dispatch('toast', { type: 'success', text: '{{ __('category.success') }}' });

        {{-- add newly added user to team list --}}
        $dispatch('add-team-member', res.data.user);
    },
}">
    <x-modal id='projectModal' :title="__('project.invite_title')" event="project-invite-modal" action="open($event.detail)">
        <form class="mt-5" method="post" x-ref='projectForm' x-on:submit.prevent="save" novalidate>
            @csrf
            <div class="flex flex-row flex-wrap">
                <label for="user-email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 w-full md:w-1/5">{{ __('Email') }}</label>
                <div class="relative w-full md:w-4/5">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <x-fas-envelope class="w-5 h-5 text-gray-500 dark:text-gray-400" />
                    </div>
                    <input type="email" id="user-email" class="input" placeholder="someone@example.com"
                        name="email" x-model='email' required>
                </div>
                <div class="w-full flex">
                    <div class="md:w-1/5"></div>
                    <div>
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                            <span x-show='emailErr && !emailErr.length'>
                                {{ __('validation.email', ['attribute' => __('Email')]) }}
                            </span>
                            <template x-if="emailErr && emailErr.length">
                                <span x-text='emailErr'></span>
                            </template>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-4 text-end">
                <x-btn-with-spinner icon='fas-save' type='submit' desc='invite new user' busy='saving'>
                    {{ __('project.invite') }}
                </x-btn-with-spinner>
            </div>
        </form>
    </x-modal>
</div>

<div x-data="{
    team: @if(Auth::user()->can('update', $project))JSON.parse('{{json_encode($project->team)}}') @else[] @endif,
    insert: function(user) {
        this.team.push(user);
    },
    del: function(hash) {
        this.team.splice(this.team.findIndex(x => x.id_hash === hash), 1);

        {{-- remove user from list --}}
        const avatar = document.querySelector('#avatar-' + hash);
        avatar.style.display = 'none';
    },
    appendToList: function({ slug, blade }) {
        const teamImagesContainer = document.querySelector('#' + slug + '-team');
        teamImagesContainer.innerHTML += blade;
    },
}" x-on:team-list-add.window="insert($event.detail)" x-on:team-list-remove.window="del($event.detail)" x-on:team-avatar-add.window="appendToList($event.detail)" x-show='team.length' x-transition>
    @can('update', $project)
        <x-card id="team" class="w-full my-3">
            <x-slot name='title'>
                {{ __('project.team_members') }}
            </x-slot>
            <x-slot name='body'>
                <template x-for='user in team' :key='user.id_hash'>
                    <div x-bind:id="'user-' + user.id_hash"
                        class="flex items-center justify-between py-2 border-b border-gray-500">
                        <div x-bind:id="user.id_hash" class="flex items-center justify-between">
                            <img x-bind:src="user.avatar"
                                class="w-10 h-10 border-2 border-white rounded-full dark:border-gray-800"
                                alt='profile photo' />
                            <span class="mx-1" x-text='user.name'></span>
                        </div>
                        <div x-data="{
                            removing: '',
                            url: '{{ route('projects.refuse', [$category->slug, $project->slug, 'id_hash_pl']) }}',
                            remove: async function(slug, hash) {
                                if (this.removing) return;
                                this.removing = slug;
                        
                                const res = await axios.delete(this.url.replace('id_hash_pl', hash)).catch(err => {});
                        
                                this.removing = '';
                        
                                if (!res || res.status !== 204) {
                                    $dispatch('toast', {
                                        type: 'error',
                                        text: '{{ __('category.erorr') }}'
                                    });
                                    return;
                                }
                        
                                $dispatch('toast', {
                                    type: 'success',
                                    text: '{{ __('category.success') }}'
                                });
                        
                                this.del(hash);
                            },
                        }">
                            <x-btn-with-spinner icon="fas-trash" type='button' desc='remove user from team'
                                busy="(removing === '{{ $project->slug }}')" class="red"
                                x-on:click.prevent="remove('{{ $project->slug }}', user.id_hash)">
                                <span class="hidden lg:inline-block">
                                    {{ __('project.remove') }}
                                </span>
                            </x-btn-with-spinner>
                        </div>
                    </div>
                </template>
            </x-slot>

            <x-slot name='footer'>
                {{-- nothing here --}}
            </x-slot>
        </x-card>
    @endcan
</div>

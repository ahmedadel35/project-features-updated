<x-app-layout>
    <x-slot name='header'>
        <div class="flex flex-row flex-wrap justify-between">
            <div class="hidden my-1 md:my-2 sm:inline-block">
                <x-breadcrump :links="[
                    [
                        'url' => route('categories.index'),
                        'name' => 'categories',
                    ],
                    [
                        'url' => route('categories.show', $category->slug),
                        'no_trans' => true,
                        'name' => $category->title,
                    ],
                    [
                        'url' => '#',
                        'no_trans' => true,
                        'name' => __('nav.projects'),
                    ],
                    [
                        'url' => '#',
                        'no_trans' => true,
                        'name' => $project->name,
                    ],
                ]" current='tasks' />
            </div>
        </div>
    </x-slot>

    <div class="flex flex-row flex-wrap">
        <div class="flex flex-col w-full md:w-3/4">
            @include('task.form')

            <div class="flex flex-col flex-wrap w-full px-1 my-3" id="tasks" x-data="{
                tasks: [],
                loadingArr: [],
                toggle: false,
                deleting: '',
                nextPage: null,
                prevPage: null,
                loadTasks: async function(url) {
                    if (this.loadingArr.length || !url || !url.length) return;
            
                    this.loadingArr = Array(7).fill(0);
            
                    const res = await axios.get(url).catch(err => {});
            
                    this.loadingArr = [];
            
                    if (!res || !res.data.tasks) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{ __('category.error') }}',
                        });
                        return;
                    }
            
                    this.tasks = res.data.tasks.data;
                    this.nextPage = res.data.tasks.next_page_url;
                    this.prevPage = res.data.tasks.prev_page_url;
                },
                toggleBadge: function(show) {
                    {{-- hide project completed state if visible --}}
                    const badge = document.querySelector('#{{ $project->slug }} #completed-badge');
                    if (show) {
                        badge.classList.remove('hidden');
                        return;
                    }
                    badge.classList.add('hidden');
                },
                insert: function(task) {
                    this.tasks.unshift(task);
                    this.toggleBadge(false);
                },
                remove: async function(id) {
                    if (this.deleting === id) return;
            
                    this.deleting = id;
            
                    const res = await axios.delete('{{ str_replace(25, '', route('tasks.destroy', [$category->slug, $project->slug, 25])) }}' + id).catch(err => {});
            
                    this.deleting = '';
            
                    if (!res || res.status !== 204) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{ __('category.error') }}'
                        });
                        return;
                    }
            
                    $dispatch('toast', {
                        type: 'warning',
                        text: '{{ __('category.success') }}'
                    });
                    this.tasks.splice(
                        this.tasks.findIndex(x => x.id === id),
                        1
                    );
                },
                update: function(task) {
                    this.tasks.map(x => {
                        if (x.id === task.id) {
                            x.body = task.body;
                            {{-- check if task was checked --}}
                            {{-- and user unchecked it --}}
                            if (x.completed && !task.completed) {
                                {{-- then remove completed badge from project --}}
                                this.toggleBadge(false);
                            }
                            x.completed = task.completed;
                        }
                        return x;
                    });
                },
                complete: async function(task) {
                    if (this.toggle) return;
            
                    this.toggle = task.id;
            
                    const route = '{{ route('tasks.toggle', [$category->slug, $project->slug, 'id-place-holder']) }}';
                    const res = await axios.put(route.replace('id-place-holder', task.id), {
                        completed: !task.completed,
                    }).catch(err => {});
            
                    this.toggle = false;
                    if (!res || !res.data) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{ __('category.error') }}'
                        });
                        return;
                    }
            
                    this.tasks.map(x => {
                        if (x.id === task.id) {
                            x.completed = !x.completed;
                        }
                        return x;
                    });
            
            
                    {{-- toggle project completed state --}}
                    this.toggleBadge(res.data.project_completed);
                },
                notify: function(info, body, user, type) {
                    if (typeof type === 'undefined') {
                        type = 'success';
                    }
            
                    $dispatch('toast', {
                        type: type,
                        text: '{{ __('auth.notify') }}',
                        info: user.name + info + body.substr(0, 10) + '...',
                        img: user.avatar,
                    });
                },
                registerTaskEventListener: function() {
                    window.Echo.join('project.{{ $project->slug }}.tasks').here((users) => {
                            $dispatch('set-users', users);
                        })
                        .joining((user) => {
                            $dispatch('add-user', user);
                        })
                        .leaving((user) => {
                            $dispatch('remove-user', user);
                        })
                        .listen('.TaskEvent', (e) => {
                            {{-- handle response --}}
                            {{-- types =>  created | updated | deleted --}}
                            if (e.type === 'created') {
                                this.notify(
                                    ' {{ __('task.word_created') }} ',
                                    e.task.body,
                                    e.user
                                );
                                this.insert(e.task);
                            } else if (e.type === 'updated') {
                                this.notify(
                                    ' {{ __('task.word_updated') }} ',
                                    e.task.body,
                                    e.user
                                );
                                this.update(e.task);
                            } else if (e.type === 'deleted') {
                                this.notify(
                                    ' {{ __('task.word_deleted') }} ',
                                    e.task.body,
                                    e.user
                                );
                                this.tasks.splice(
                                    this.tasks.findIndex(x => x.id === e.task.id),
                                    1
                                );
                            }
                        });
                },
            }"
                x-init="loadTasks('{{ route('tasks.index', [$category->slug, $project->slug]) }}');
                registerTaskEventListener()" x-on:add-task.window="insert($event.detail.task)"
                x-on:update-task.window="update($event.detail.task)">
                <template x-for="task in tasks" :key="task.id">
                    @include('task.show', compact('project', 'category'))
                </template>
                <template x-if="loadingArr.length <= 0 && tasks.length <= 0">
                    <div>
                        @include('task.placeholder')
                        <h4 class="text-4xl text-center dark:text-white">
                            {{ __('task.start') }}
                        </h4>
                    </div>
                </template>
                <template x-for="l in loadingArr" :key="Math.random() * 1000">
                    @include('task.placeholder')
                </template>

                <div class="flex items-center justify-between px-5 my-3" x-show="prevPage || nextPage">
                    <button class="btn purple" type="button" aria-describedby="previos page"
                        x-on:click.prevent="loadTasks(prevPage)" x-bind:disapled="!prevPage">
                        <x-fas-chevron-left />
                    </button>
                    <button class="btn purple" type="button" aria-describedby="next page"
                        x-on:click.prevent="loadTasks(nextPage)" x-bind:disapled="!nextPage">
                        <x-fas-chevron-right />
                    </button>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full md:w-1/4 px-4 py-2">
            @include('project.show', ['p' => $project, 'class' => 'w-full'])

            @include('task.index.active-users')

            @includeWhen(Auth::user()->can('update', $project), 'task.index.team')
        </div>
    </div>

    <x-popup />
    @include('project.index.invite-modal')
</x-app-layout>

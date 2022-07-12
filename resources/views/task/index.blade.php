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
                        'name' => 'projects',
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

            <div class="my-3 flex flex-col flex-wrap w-full px-1" id="tasks" x-data="{
                tasks: [],
                loading: false,
                toggle: false,
                url: '{{route('tasks.index', [$category->slug, $project->slug])}}',
                deleting: '',
                loadTasks: async function() {
                    if (this.loading) return;

                    this.loading = true;

                    const res = await axios.get(this.url).catch(err => {})

                    if (!res || !res.data.tasks) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{__('category.error')}}',
                        })
                        return;
                    }

                    this.tasks = res.data.tasks.data
                },
                remove: async function(id)
                {
                    if (this.deleting === id) return;

                    this.deleting = id;

                    const res = await axios.delete('{{str_replace(25, '', route('tasks.destroy', [$category->slug, $project->slug, 25]))}}' + id).catch(err => {})

                    this.deleting = '';

                    if (!res || res.status !== 204) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{__('category.error')}}'
                        })
                        return;
                    }

                    $dispatch('toast', {
                        type: 'success',
                        text: '{{__('category.success')}}'
                    })
                    this.tasks.splice(
                        this.tasks.findIndex(x => x.id === id),
                        1
                    )
                },
                update: function(task) {
                    this.tasks.map(x => {
                        if (x.id === task.id) {
                            x.body = task.body;
                        }
                        return x;
                    })
                },
                complete: async function(task) {
                    if (this.toggle) return;

                    this.toggle = task.id;
                    
                    const route = '{{route('tasks.toggle', [
                        $category->slug,
                        $project->slug,
                        'id-place-holder'
                    ])}}';
                    const res = await axios.put(route.replace('id-place-holder', task.id), {
                        completed: !task.completed,
                    }).catch(err => {})

                    this.toggle = false;
                    if (!res || res.status !== 204) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{__('category.error')}}'
                        })
                        return;
                    }
                    
                    this.tasks.map(x => {
                        if (x.id === task.id) {
                            x.completed = !x.completed;
                        }
                        return x;
                    })
                },
            }" x-init="loadTasks" x-on:add-task.window="tasks.unshift($event.detail.task)" x-on:update-task.window="update($event.detail.task)">
                <template x-for="task in tasks" :key="task.id">
                    @include('task.show', compact('project', 'category'))
                </template>
                <template x-if="loading">
                    <h1>loading</h1>
                </template>
            </div>
        </div>
        <div class="flex flex-row flex-wrap w-full md:w-1/4">
            @include('project.show', ['p' => $project, 'class' => ''])
        </div>
    </div>

    <x-popup />
    @include('project.index.invite-modal')
</x-app-layout>

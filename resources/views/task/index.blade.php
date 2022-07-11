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
        <div class="flex flex-row flex-wrap w-full md:w-3/4">
        </div>
        <div class="flex flex-row flex-wrap w-full md:w-1/4">
            @include('project.show', ['p' => $project, 'class' => ''])
        </div>
    </div>

    <x-popup />
    @include('project.index.invite-modal')
</x-app-layout>

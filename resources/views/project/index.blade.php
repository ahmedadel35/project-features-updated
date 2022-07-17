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
                        'url' => '#',
                        'no_trans' => true,
                        'name' => $category?->title,
                    ],
                ]" current='projects' />
            </div>
            <div class="my-1 md:my-2">
                <x-btn-with-spinner tag='a' href="{{ route('projects.create', $category?->slug) }}"
                    desc="create new project" icon="fas-plus">
                    {{ __('category.create') }}
                </x-btn-with-spinner>
            </div>
        </div>

        @include('project.index.filter-modal')
    </x-slot>

    <div class="flex flex-row flex-wrap">
        <div class="flex flex-row flex-wrap w-full md:w-3/4">
            @forelse($projects as $p)
                @include('project.show', compact('p'))
            @empty
                @include('project.index.empty')
            @endforelse
        </div>
        <div class="w-full md:w-1/4">
            @includeWhen($category !== null, 'category.show', [
                'cat' => $category,
                'class' => '',
            ])
        </div>
    </div>

    <div class="py-5 px-2 md:px-4">
        {{ $projects->links() }}
    </div>

    <button
        class="md:hidden fixed !p-0 !rounded-full right-5 bottom-32 btn teal w-10 h-10 opacity-80 transition-opacity hover:opacity-100"
        x-data x-on:click.prevent="$dispatch('filter-modal', {})">
        <x-fas-filter class="!w-5 !h-5 !m-0" />
    </button>

    <x-popup />
    @include('project.index.invite-modal')
</x-app-layout>

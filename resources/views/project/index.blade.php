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
                <x-card :id='$p->slug' class="w-full p-3 sm:w-1/2 lg:w-1/3 sm:px-2 md:px-4" :url="route('projects.show', [$category?->slug ?? $p->category->slug, $p->slug])">
                    <x-slot name='title'>
                        {{ $p->name }}
                    </x-slot>

                    <x-slot name='body'>
                        <div class="p-2 font-semibold text-blue-600 rounded dark:text-blue-400">
                            {{ numfmt_format_currency(numfmt_create('usd', NumberFormatter::CURRENCY), $p->cost, 'USD') }}
                        </div>

                        @if ($p->completed)
                            <div
                                class="absolute top-0 ltr:right-0 rtl:left-0 rounded px-2 py-1 bg-green-800 dark:bg-green-600 text-white !bg-opacity-75">
                                {{ __('project.completed') }}
                            </div>
                        @endif

                        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                            {{ $p->info }}
                        </p>

                        <div class='flex justify-end my-1 -space-x-4' id="{{ $p->slug }}-team">
                            @foreach ($p->team as $team_user)
                                <x-avatar :src="$team_user->avatar" :title="$team_user->name"
                                    alt='{{ $team_user->name }} profile photo' />
                            @endforeach
                        </div>
                    </x-slot>

                    <x-slot name='footer'>
                        @can('update', $p)
                            <button type="button" class="btn teal" aria-describedby="invite user to team" x-data
                                x-on:click.prevent="$dispatch('project-invite-modal', {
                                slug: '{{ $p->slug }}',
                                url: '{{ route('projects.invite', [$category?->slug ?? $p->category->slug, $p->slug]) }}'
                            })">
                                <x-fas-users />
                                {{ __('project.invite') }}
                            </button>
                            <x-btn-with-spinner tag='a'
                                href="{{ route('projects.edit', [$category?->slug ?? $p->category->slug, $p->slug]) }}"
                                desc="edit project {{ $p->slug }}" icon="fas-pencil">
                                <span class="sm:hidden lg:inline-block">
                                    {{ __('category.edit') }}
                                </span>
                            </x-btn-with-spinner>

                            <x-btn-delete :url="route('projects.destroy', [$category?->slug ?? $p->category->slug, $p->slug])" :id="$p->slug"></x-btn-delete>
                        @endcan
                    </x-slot>
                </x-card>
            @empty
                @include('project.index.empty')
            @endforelse
        </div>
        <div class="w-full md:w-1/4">
            @if ($category !== null)
                <div class="flex justify-center mx-auto my-2">
                    <x-card :id="$category->slug" class="w-full">
                        <x-slot name='title'>
                            {{ $category->title }}
                        </x-slot>

                        <x-slot name='body'>
                            <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                                {{ $category->description }}
                            </p>
                        </x-slot>

                        <x-slot name='footer'>
                            <x-btn-delete :url="route('categories.destroy', $category->slug)" :to="route('categories.index')" :id="$category->slug" />
                        </x-slot>
                    </x-card>
                </div>
            @endif
        </div>
    </div>

    <button
        class="md:hidden fixed !p-0 !rounded-full right-5 bottom-32 btn teal w-10 h-10 opacity-80 transition-opacity hover:opacity-100"
        x-data x-on:click.prevent="$dispatch('filter-modal', {})">
        <x-fas-filter class="!w-5 !h-5 !m-0" />
    </button>
    <div class="py-5">
        {{ $projects->links() }}
    </div>

    <x-popup />
    @include('project.index.invite-modal')
</x-app-layout>

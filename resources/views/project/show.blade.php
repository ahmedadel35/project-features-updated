<x-card :id='$p->slug' class="w-full p-3 {{ $class ?? 'sm:w-1/2 lg:w-1/3 sm:px-2 md:px-4' }}" :url="route('projects.show', [$category?->slug ?? $p->category->slug, $p->slug])">
    <x-slot name='title'>
        {{ $p->name }}
    </x-slot>

    <x-slot name='body'>
        <div class="p-2 font-semibold text-blue-600 rounded dark:text-blue-400">
            {{ numfmt_format_currency(numfmt_create('usd', NumberFormatter::CURRENCY), $p->cost, 'USD') }}
        </div>

        <div
            id="completed-badge"
            class="@unless($p->completed)hidden @endunless absolute top-0 ltr:right-0 rtl:left-0 rounded px-2 py-1 bg-green-800 dark:bg-green-600 text-white !bg-opacity-75">
            {{ __('project.completed') }}
        </div>

        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
            {{ $p->info }}
        </p>

        <div class='flex justify-end my-1 -space-x-4' id="{{ $p->slug }}-team">
            @foreach ($p->team as $team_user)
                <x-avatar :src="$team_user->avatar" :title="$team_user->name" alt='{{ $team_user->name }} profile photo' />
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

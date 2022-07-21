<x-card :id='$p->slug' class="{{$class ?? 'w-full p-3 sm:w-1/2 md:w-1/3 lg:w-1/4 2xl:w-1/5 sm:px-2 md:px-3'}}" :url="route('projects.show', [$category?->slug ?? $p->category->slug, $p->slug])">
    <x-slot name='title'>
        {{ $p->name }}
    </x-slot>

    <x-slot name='body'>
        <div class="p-2 font-semibold text-blue-600 rounded dark:text-blue-400">
            {{ numfmt_format_currency(numfmt_create('usd', NumberFormatter::CURRENCY), $p->cost, 'USD') }}
        </div>

        <div id="completed-badge"
            class="@unless($p->completed) hidden @endunless absolute top-0 ltr:right-0 rtl:left-0 rounded px-2 py-1 bg-green-800 dark:bg-green-600 text-white !bg-opacity-75">
            {{ __('project.completed') }}
        </div>

        <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
            {{ $p->info }}
        </p>

        <div dir="ltr" class='flex my-1 -space-x-4 ltr:justify-end rtl:justify-start rtl:pl-1 ltr:pr-1'
            id="{{ $p->slug }}-team">
            @foreach ($p->team as $team_user)
                <x-avatar :src="$team_user->avatar" :title="$team_user->name" alt='{{ $team_user->name }} profile photo' />
            @endforeach
        </div>
    </x-slot>

    <x-slot name='footer'>
        @if ($p->team->contains(fn($user) => $user->id === Auth::id()))
            <div x-data="{
                refusing: false,
                slug: '{{ $p->slug }}',
                atProjectShow: {{ request()->project !== null ? 1 : 0 }},
                remove: async function() {
                    if (this.refusing) return;
            
                    this.refusing = true;
                    const res = await axios.delete('{{ route('projects.refuse', [$category?->slug ?? $p->category->slug, $p->slug]) }}').catch(err => {});
            
                    this.refusing = false;
            
                    if (!res || res.status !== 204) {
                        $dispatch('toast', {
                            type: 'error',
                            text: '{{ __('category.erorr') }}'
                        });
                        return;
                    }
            
                    if (this.atProjectShow) {
                        {{-- redirect to all projects --}}
                        window.location.href = '{{ route('projects.index', 'all') }}';
                        return;
                    }
            
                    {{-- hide this project card --}}
                    const card = document.querySelector('#' + this.slug);
                    card.style.display = 'none';
            
                    $dispatch('toast', {
                        type: 'success',
                        text: '{{ __('category.success') }}'
                    });
                },
            }">

                <button type="button" x-on:click.prevent="remove" class="btn red"
                    aria-describedby='refuse invitation from project'>
                    <x-fas-xmark x-show="!refusing" />
                    <x-btn-spinner x-show="refusing" />
                    {{ __('project.refuse') }}
                </button>
            </div>
        @endif

        @can('update', $p)
            <button type="button" class="btn teal" aria-describedby="invite user to team" x-data
                x-on:click.prevent="$dispatch('project-invite-modal', {
                slug: '{{ $p->slug }}',
                url: '{{ route('projects.invite', [$category?->slug ?? $p->category->slug, $p->slug]) }}'
            })">
                <x-fas-users />
                <span class="sm:hidden lg:inline-block">
                    {{ __('project.invite') }}
                </span>
            </button>
            <x-btn-with-spinner tag='a'
                href="{{ route('projects.edit', [$category?->slug ?? $p->category->slug, $p->slug]) }}"
                desc="edit project {{ $p->slug }}" icon="fas-pencil" class="mx-1">
                <span class="sm:hidden lg:inline-block">
                    {{ __('category.edit') }}
                </span>
            </x-btn-with-spinner>

            <x-btn-delete :url="route('projects.destroy', [$category?->slug ?? $p->category->slug, $p->slug])" :id="$p->slug"></x-btn-delete>
        @endcan
    </x-slot>
</x-card>

<x-app-layout>
    <x-slot name='header'>
        <div class="flex flex-row flex-wrap justify-between">
            <div class="my-2">
                <x-breadcrump current='categories' />
            </div>
            <div class="my-2">
                {{-- modal toggle --}}
                <button class="btn blue" x-data x-on:click.prevent="$dispatch('category-modal', {
                    editMode: false,
                    slug: '',
                    name: '',
                    desc: '',
                })">
                    <x-fas-plus />
                    {{__('category.create')}}
                </button>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-row flex-wrap">
        @forelse($categories as $cat)
            @include('category.show', [
                'cat' => $cat,
                'canEdit' => true,
            ])
        @empty
            @include('category.index.empty')
        @endforelse

        <div class="py-5">
            {{ $categories->links() }}
        </div>
    </div>

    <x-popup />
    {{-- create modal --}}
    @include('category.create')
</x-app-layout>
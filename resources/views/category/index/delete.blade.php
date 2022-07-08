<div class="inline-block" x-data="{
    removing: false,
    remove: async function(slug) {
        if (this.removing || !slug) return;
        this.removing = true;

        const res = await axios.delete('{{ route('categories.destroy', $cat->slug) }}').catch(err => {});

        this.removing = false;

        if (!res || res.status !== 204) {
            $dispatch('toast', {type: 'error', text: '{{__("category.error")}}' });
            return;
        }

        $dispatch('toast', {type: 'success', text: '{{__("category.success")}}' })

        {{-- remove element from dom --}}
        const el = document.querySelector('#' + slug)
        el.remove();
    },
}">
    <x-btn-with-spinner class="red" type="button" icon='fas-trash'
        desc='delete category {{ $cat->slug }}' busy='removing' x-on:click.prevent="remove('{{$cat->slug}}')">
        Delete
    </x-btn-with-spinner>
</div>
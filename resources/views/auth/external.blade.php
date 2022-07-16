<div class="mt-3 py-3 flex items-center justify-between border-t border-gray-500">
    <x-btn-with-spinner tag='a' href="{{ route('ext-login.github.redirect') }}"
        desc='login using github' class="purple" icon='fab-github'>
        <span>{{__('auth.joinas')}} {{__('auth.github')}}</span>
    </x-btn-with-spinner>
    <x-btn-with-spinner tag='a' href="{{ route('ext-login.facebook.redirect') }}"
        desc='login using facebook' class="purple" icon='fab-facebook'>
        <span>{{__('auth.joinas')}} {{__('auth.facebook')}}</span>
    </x-btn-with-spinner>
</div>
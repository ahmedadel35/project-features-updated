<div class="mt-3 py-3 flex items-center justify-between border-t border-gray-500">
    <x-btn-with-spinner tag='a' href="{{ route('ext-login.github.redirect') }}"
        desc='login using github' class="bg-[#24292F] hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50" style="background-image: none" icon='fab-github'>
        <span>{{__('auth.joinas')}} {{__('auth.github')}}</span>
    </x-btn-with-spinner>
    <x-btn-with-spinner tag='a' href="{{ route('ext-login.facebook.redirect') }}"
        desc='login using facebook' class="bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50" style="background-image: none" icon='fab-facebook'>
        <span>{{__('auth.joinas')}} {{__('auth.facebook')}}</span>
    </x-btn-with-spinner>
</div>
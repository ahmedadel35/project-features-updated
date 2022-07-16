<div class="mt-3 py-3 flex items-center justify-between border-t border-gray-500">
    <x-btn-with-spinner tag='a' href="{{ route('ext-login.github.redirect') }}"
        desc='login using github' class="purple" icon='fab-github'>
        <span>join using github</span>
    </x-btn-with-spinner>
    <x-btn-with-spinner tag='a' href="{{ route('ext-login.google.redirect') }}"
        desc='login using google' class="purple" icon='fab-google'>
        <span>join using google</span>
    </x-btn-with-spinner>
</div>
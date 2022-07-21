<div class="w-full px-2 my-3" x-data="{
    users: [],
    current: {
        name: '{{ Auth::user()->name }}',
        avatar: '{{ Auth::user()->avatar }}',
    },
    setUsers: function(users) {
        if (Array.isArray(users)) {
            {{-- remove current user from list --}}
            users = users.filter(x => x.name !== '{{ Auth::user()->name }}');
            this.users = users;
        }
    },
    addUser: function(user) {
        this.users.push(user);
        $dispatch('toast', {
            type: 'info',
            text: '{{ __('task.user_joined') }}',
            info: user.name,
        });
    },
    removeUser: function(user) {
        this.users.splice(this.users.findIndex(x => x.name === user.name), 1);
        $dispatch('toast', {
            type: 'warning',
            text: '{{ __('task.user_leaved') }}',
            info: user.name,
        });
    },
}" x-on:set-users.window="setUsers($event.detail)"
    x-on:add-user.window="addUser($event.detail)" x-on:remove-user.window="removeUser($event.detail)">
    <div class="w-full card-bg" x-show="users.length">
        <div class="text-white rounded bg-cyan-600">
            <h4 class="text-2xl text-center uppercase">
                {{ __('task.active_users') }}
            </h4>
        </div>
        <div class="p-2">
            <template x-for="user in users" :key='user.name + Math.random()'>
                <div class="flex items-center my-3 space-x-2">
                    <div class="relative w-12 h-12 overflow-hidden">
                        <img x-bind:id='user.name + "avatar"' x-bind:src="user.avatar" x-bind:title="user.name"
                            class="w-12 h-12 border-2 border-white rounded-full dark:border-gray-800" />
                        <span
                            class="bottom-0 left-7 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                    </div>
                    <div class="font-semibold dark:text-white">
                        <span x-text="user.name"></span>
                        <span></span>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

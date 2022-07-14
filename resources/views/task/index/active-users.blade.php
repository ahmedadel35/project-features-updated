<div class="my-3 px-2 w-full" x-data="{
    users: [],
    current: { name: '{{ Auth::user()->name }}', avatar: '{{ Auth::user()->avatar }}' },
    addUser: function(user) {
        this.users.push(user);
        $dispatch('toast', {
            type: 'info',
            text: '{{ __('task.user_joined') }}',
            info: user.name,
        })
    },
    removeUser: function(user) {
        this.users.splice(this.users.findIndex(x => x.name === user.name), 1)
        $dispatch('toast', {
            type: 'warning',
            text: '{{ __('task.user_leaved') }}',
            info: user.name,
        });

    },
}" x-on:set-users.window="users = $event.detail"
    x-on:add-user.window="addUser($event.detail)" x-on:remove-user.window="removeUser($event.detail)">
    <div class="card-bg w-full" x-show="users.length">
        <div class="bg-cyan-600 text-white rounded">
            <h4 class="text-2xl text-center uppercase">Active Users</h4>
        </div>
        <template x-for="user in users" :key='user.name'>
            <div class="flex items-center space-x-2 my-3"
                x-show="user.name !== current.name && user.avatar !== current.avatar">
                <div class="overflow-hidden w-12 h-12 relative">
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

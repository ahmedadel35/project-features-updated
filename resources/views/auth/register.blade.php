<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div x-data="{
            registering: false,
            submit: function() {
                if ($refs.form.checkValidity()) {
                    this.registering = true;
                }
            }
        }">
            <form x-ref='form' x-on:submit="submit" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('auth.Name')" />

                    <x-input id="name" class="form-input w-full" type="text" name="name" :value="old('name')"
                        required autofocus />
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('auth.Email')" />

                    <x-input id="email" class="form-input w-full" type="email" name="email" :value="old('email')"
                        required />
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('auth.Password')" />

                    <x-input id="password" class="form-input w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('auth.Confirm Password')" />

                    <x-input id="password_confirmation" class="form-input w-full" type="password"
                        name="password_confirmation" required />
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <x-btn-with-spinner tag='a' desc='go to login page' class=""
                        icon='fas-right-to-bracket' href="{{ route('login') }}">
                        {{ __('auth.Already registered?') }}
                    </x-btn-with-spinner>

                    <x-btn-with-spinner type='submit' class="green" icon="fas-user-plus" desc='tegister'
                        busy='registering'>
                        {{ __('auth.Register') }}
                    </x-btn-with-spinner>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-app-layout>

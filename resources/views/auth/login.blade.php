<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div x-data="{
            form: {
                email: '{{old('email')}}',
                pass: '',
            },
            error: {
                email: null,
                pass: null,
            },
            logging: false,
            submit: function() {
                if (this.logging) return;
        
                this.error.email = this.error.pass = false;
        
                {{-- filter inputs --}}
                if (!this.form.pass.length) {
                    this.error.pass = true;
                }
                if (!this.form.email.length || !$store.common.testMail(this.form.email)) {
                    this.error.email = true;
                }
                if (this.error.email || this.error.pass) return;
        
                this.logging = true;
        
                $refs.form.submit();
            },
        }">
            <form method="POST" x-on:submit.prevent="submit" x-ref='form' action="{{ route('login') }}" class=""
                novalidate>
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('auth.Email')" class="form-label" />

                    <x-input id="email" class="form-input w-full" type="email" name="email" :value="old('email')"
                        placeholder="example@website.com" x-model.trim='form.email' required autofocus />
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('email')
                            {{ $message }}
                        @enderror
                        <span x-show='error.email'>
                            {{ __('validation.email', ['attribute' => __('auth.Email')]) }}
                        </span>
                    </p>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('auth.Password')" />

                    <x-input id="password" class="form-input w-full" type="password" name="password"
                        placeholder="{{ __('auth.Password') }}" x-model.trim='form.pass' required
                        autocomplete="current-password" />
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @error('password')
                            {{ $message }}
                        @enderror
                        <span x-show="error.pass">
                            {{ __('validation.required', ['attribute' => __('auth.Password')]) }}
                        </span>
                    </p>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="mx-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="remember">
                        <span
                            class="ml-2 text-sm text-gray-600 dark:text-gray-500">{{ __('auth.Remember-Me') }}</span>
                    </label>
                </div>

                <div class="flex justify-between items-center my-3">
                    <x-btn-with-spinner type='submit' class="cyan" icon="fas-right-to-bracket" desc='login'
                        busy='logging'>
                        {{ __('auth.Login') }}
                    </x-btn-with-spinner>

                    <x-btn-with-spinner tag='a' href="{{ route('register') }}" class="purple"
                        icon="fas-user-plus" desc='register'>
                        {{ __('auth.Register') }}
                    </x-btn-with-spinner>
                </div>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300"
                        href="{{ route('password.request') }}">
                        {{ __('auth.Forgot-Your-Password?') }}
                    </a>
                @endif

                <div class="my-2">
                    <x-button type='button' class="btn green"
                        x-on:click.prevent="form.email = 'user1@site.com'; form.pass = 'password';">
                        {{__('auth.user1')}}
                    </x-button>

                    <x-button type='button' class="btn green"
                        x-on:click.prevent="form.email = 'user2@site.com'; form.pass = 'password';">
                        {{__('auth.user2')}}
                    </x-button>
                </div>

                @include('auth.external')
            </form>
        </div>
    </x-auth-card>
</x-app-layout>

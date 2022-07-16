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
                email: '',
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
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-500">{{ __('auth.Remember_me') }}</span>
                    </label>
                </div>

                <div class="flex justify-between items-center my-3">
                    <x-btn-with-spinner type='submit' class="cyan" icon="fas-right-to-bracket" desc='login'
                        busy='logging'>
                        {{ __('auth.Log_in') }}
                    </x-btn-with-spinner>

                    <x-btn-with-spinner tag='a' href="{{ route('register') }}" class="purple"
                        icon="fas-user-plus" desc='register'>
                        {{ __('auth.register') }}
                    </x-btn-with-spinner>
                </div>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-500 dark:hover:text-gray-300"
                        href="{{ route('password.request') }}">
                        {{ __('auth.Forgot_your_password?') }}
                    </a>
                @endif

                <div class="my-2" x-data="{
                    setVal: function(m, p) {
                        const email = document.querySelector('#email');
                        const pass = document.querySelector('#password');
                
                        email.value = m;
                        pass.value = p;
                    }
                }">
                    <x-button type='button' class="btn green"
                        x-on:click.prevent="setVal(
                        'admin@site.com',
                        'password',
                    )">
                        user1
                    </x-button>

                    <x-button type='button' class="btn green"
                        x-on:click.prevent="setVal(
                        'user@site.com',
                        'password',
                    )">
                        User2
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-app-layout>

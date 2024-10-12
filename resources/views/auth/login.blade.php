<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username or Email Address -->
        <div>
            <x-input-label for="login" :value="__('Username or Email')" />
            <x-text-input class="block mt-1 w-full" id="login" name="login" type="text" :value="old('login')" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('login')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input class="block mt-1 w-full" id="password" name="password" type="password" required autocomplete="current-password" />

            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label class="inline-flex items-center" for="remember_me">
                <input class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" id="remember_me" name="remember" type="checkbox">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

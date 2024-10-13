<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input class="block mt-1 w-full" id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input class="block mt-1 w-full" id="username" name="username" type="text" :value="old('username')" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input class="block mt-1 w-full" id="alamat" name="alamat" type="text" :value="old('alamat')" required autocomplete="alamat" />
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="mt-4">
            <x-input-label for="nomor_telepon" :value="__('Nomor Telepon')" />
            <x-text-input class="block mt-1 w-full" id="nomor_telepon" name="nomor_telepon" type="text" :value="old('nomor_telepon')" required autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('nomor_telepon')" />
        </div>

        <div class="mt-4">
            <x-input-label for="nomor_sim" :value="__('Nomor SIM')" />
            <x-text-input class="block mt-1 w-full" id="nomor_sim" name="nomor_sim" type="text" :value="old('nomor_sim')" required autocomplete="nomor_sim" />
            <x-input-error class="mt-2" :messages="$errors->get('nomor_sim')" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input class="block mt-1 w-full" id="email" name="email" type="email" :value="old('email')" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input class="block mt-1 w-full" id="password" name="password" type="password" required autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
            <x-text-input class="block mt-1 w-full" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" />
            <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

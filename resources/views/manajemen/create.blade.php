<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Mobil Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form Tambah Mobil -->
                    <form method="POST" action="{{ route('manajemen.store') }}">
                        @csrf

                        <!-- Merek -->
                        <div class="mb-4">
                            <x-input-label for="merek" :value="__('Merek')" />
                            <x-text-input class="block mt-1 w-full" id="merek" name="merek" type="text" :value="old('merek')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('merek')" />
                        </div>

                        <!-- Model -->
                        <div class="mb-4">
                            <x-input-label for="model" :value="__('Model')" />
                            <x-text-input class="block mt-1 w-full" id="model" name="model" type="text" :value="old('model')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('model')" />
                        </div>

                        <!-- Nomor Plat -->
                        <div class="mb-4">
                            <x-input-label for="nomor_plat" :value="__('Nomor Plat')" />
                            <x-text-input class="block mt-1 w-full" id="nomor_plat" name="nomor_plat" type="text" :value="old('nomor_plat')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nomor_plat')" />
                        </div>

                        <!-- Tarif Sewa per Hari -->
                        <div class="mb-4">
                            <x-input-label for="tarif_sewa_per_hari" :value="__('Tarif Sewa per Hari')" />
                            <x-text-input class="block mt-1 w-full" id="tarif_sewa_per_hari" name="tarif_sewa_per_hari" type="number" step="0.01" :value="old('tarif_sewa_per_hari')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tarif_sewa_per_hari')" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <x-primary-button class="ml-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

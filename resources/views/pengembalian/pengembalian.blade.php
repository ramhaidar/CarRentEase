<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Pengembalian Mobil') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Masukkan Nomor Plat Mobil untuk Dikembalikan') }}</h3>
                    <form class="mt-6" method="POST" action="{{ route('pengembalian.store') }}">@csrf<div class="mb-4"><x-input-label for="nomor_plat" :value="__('Nomor Plat')" /><x-text-input class="block mt-1 w-full" id="nomor_plat" name="nomor_plat" type="text" required autofocus autocomplete="off" /></div><x-primary-button class="mt-4">{{ __('Kembalikan Mobil') }}</x-primary-button></form>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('deleted'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Dihapus',
                text: '{{ session('deleted') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    </script>
</x-app-layout>

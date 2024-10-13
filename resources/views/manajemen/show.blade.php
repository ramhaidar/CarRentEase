<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ $mobil->merek }} {{ $mobil->model }}</h3>
                    <p>{{ __('Nomor Plat: ') }} {{ $mobil->nomor_plat }}</p>
                    <p>{{ __('Tarif Sewa per Hari: ') }} Rp{{ number_format($mobil->tarif_sewa_per_hari, 0, ',', '.') }}</p>
                    <p>{{ __('Ketersediaan (Hari Ini): ') }}
                        @php
                            $isAvailable = !$mobil->peminjamans()->where('tanggal_mulai', '<=', now())->where('tanggal_selesai', '>=', now())->where('status_pengembalian', false)->exists();
                        @endphp
                        @if ($isAvailable)
                            <span class="text-green-600">{{ __('Tersedia') }}</span>
                        @else
                            <span class="text-red-600">{{ __('Tidak Tersedia') }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

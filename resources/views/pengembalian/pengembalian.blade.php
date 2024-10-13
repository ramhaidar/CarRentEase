<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Pengembalian Mobil') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Masukkan Nomor Plat Mobil untuk Dikembalikan') }}</h3>
                    <form class="mt-6" method="POST" action="{{ route('pengembalian.store') }}">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="nomor_plat" :value="__('Nomor Plat')" />
                            <x-text-input class="block mt-1 w-full" id="nomor_plat" name="nomor_plat" type="text" required autofocus autocomplete="off" />
                        </div>
                        <x-primary-button class="mt-4">{{ __('Kembalikan Mobil') }}</x-primary-button>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Riwayat Pengembalian') }}</h3>

                    <div class="overflow-x-auto mt-6">
                        <table class="w-full table-auto bg-white dark:bg-gray-800">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                    <th class="px-4 py-2">{{ __('Mobil') }}</th>
                                    <th class="px-4 py-2">{{ __('Nomor Plat') }}</th>
                                    <th class="px-4 py-2">{{ __('Tanggal Pengembalian') }}</th>
                                    <th class="px-4 py-2">{{ __('Jumlah Hari') }}</th>
                                    <th class="px-4 py-2">{{ __('Total Biaya') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengembalians as $pengembalian)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $pengembalian->peminjaman->mobil->merek }} - {{ $pengembalian->peminjaman->mobil->model }}</td>
                                        <td class="px-4 py-2">{{ $pengembalian->peminjaman->mobil->nomor_plat }}</td>
                                        <td class="px-4 py-2">{{ $pengembalian->tanggal_pengembalian->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2">{{ $pengembalian->jumlah_hari }}</td>
                                        <td class="px-4 py-2">Rp{{ number_format($pengembalian->total_biaya, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($pengembalians->isEmpty())
                        <div class="mt-6 text-center text-gray-600 dark:text-gray-400">{{ __('Belum ada data pengembalian mobil.') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

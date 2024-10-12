<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Peminjaman Mobil') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">{{ __('Mobil Sedang Dipinjam') }}</h3><a class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600" href="{{ route('peminjaman.create') }}">{{ __('Pinjam Mobil') }}</a>
                    </div>
                    <div class="overflow-x-auto mt-6">
                        <table class="w-full table-auto bg-white dark:bg-gray-800">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                    <th class="px-4 py-2">{{ __('Merek') }}</th>
                                    <th class="px-4 py-2">{{ __('Model') }}</th>
                                    <th class="px-4 py-2">{{ __('Nomor Plat') }}</th>
                                    <th class="px-4 py-2">{{ __('Tanggal Mulai') }}</th>
                                    <th class="px-4 py-2">{{ __('Tanggal Selesai') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamans as $peminjaman)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $peminjaman->mobil->merek }}</td>
                                        <td class="px-4 py-2">{{ $peminjaman->mobil->model }}</td>
                                        <td class="px-4 py-2">{{ $peminjaman->mobil->nomor_plat }}</td>
                                        <td class="px-4 py-2">{{ $peminjaman->tanggal_mulai->format('Y-m-d') }}</td>
                                        <td class="px-4 py-2">{{ $peminjaman->tanggal_selesai->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($peminjamans->isEmpty())
                        <div class="mt-6 text-center text-gray-600 dark:text-gray-400">{{ __('Tidak ada mobil yang sedang dipinjam.') }}</div>
                    @endif
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

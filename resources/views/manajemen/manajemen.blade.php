<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Manajemen Mobil') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">{{ __('Daftar Mobil') }}</h3>
                        <a class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600" href="{{ route('manajemen.create') }}">{{ __('Tambah Mobil Baru') }}</a>
                    </div>
                    <form class="mb-6" method="GET" action="{{ route('manajemen.index') }}">
                        <div class="flex items-center">
                            <input class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-gray-300" name="merek" type="text" placeholder="Cari Merek">
                            <input class="w-full ml-2 px-4 py-2 rounded-md border border-gray-300 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-gray-300" name="model" type="text" placeholder="Cari Model">
                            <button class="ml-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600" type="submit">{{ __('Cari') }}</button>
                        </div>
                    </form>
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto bg-white dark:bg-gray-800">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                    <th class="px-4 py-2">{{ __('Merek') }}</th>
                                    <th class="px-4 py-2">{{ __('Model') }}</th>
                                    <th class="px-4 py-2">{{ __('Nomor Plat') }}</th>
                                    <th class="px-4 py-2">{{ __('Tarif Sewa per Hari') }}</th>
                                    <th class="px-4 py-2">{{ __('Ketersediaan') }}</th>
                                    <th class="px-4 py-2">{{ __('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mobils as $mobil)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $mobil->merek }}</td>
                                        <td class="px-4 py-2">{{ $mobil->model }}</td>
                                        <td class="px-4 py-2">{{ $mobil->nomor_plat }}</td>
                                        <td class="px-4 py-2">{{ number_format($mobil->tarif_sewa_per_hari, 2) }}</td>
                                        <td class="px-4 py-2">
                                            @if ($mobil->tersedia)
                                            <span class="text-green-600 font-semibold">{{ __('Tersedia') }}</span>@else<span class="text-red-600 font-semibold">{{ __('Tidak Tersedia') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 flex items-center space-x-4">
                                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('manajemen.show', $mobil->id) }}"><i class="fas fa-eye"></i></a>
                                            <a class="text-yellow-500 hover:text-yellow-700" href="{{ route('manajemen.edit', $mobil->id) }}"><i class="fas fa-edit"></i></a>
                                            <button class="text-red-600 hover:text-red-900 open-modal" data-id="{{ $mobil->id }}"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($mobils->isEmpty())
                        <div class="mt-6 text-center text-gray-600 dark:text-gray-400">{{ __('Tidak ada mobil yang tersedia.') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200" id="modal-title">{{ __('Konfirmasi Hapus') }}</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-300">{{ __('Apakah Anda yakin ingin menghapus mobil ini? Tindakan ini tidak dapat dibatalkan.') }}</p>
                </div>
                <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                    <form id="delete-form" style="display: inline;" method="POST">@csrf @method('DELETE')
                        <button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" type="submit">{{ __('Hapus') }}</button>
                    </form>
                    <button class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="close-modal" type="button">{{ __('Batal') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function() {
            $('.open-modal').click(function() {
                var mobilId = $(this).data('id');
                $('#delete-form').attr('action', '/manajemen/' + mobilId);
                $('#modal').removeClass('hidden');
            });
            $('#close-modal').click(function() {
                $('#modal').addClass('hidden');
            });
        });
    </script>

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

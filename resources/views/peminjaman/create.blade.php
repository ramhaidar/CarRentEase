<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Pilih Mobil untuk Dipinjam') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">{{ __('Mobil Tersedia untuk Dipinjam') }}</h3>
                    <div class="overflow-x-auto mt-6">
                        <table class="w-full table-auto bg-white dark:bg-gray-800">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                    <th class="px-4 py-2">{{ __('Merek') }}</th>
                                    <th class="px-4 py-2">{{ __('Model') }}</th>
                                    <th class="px-4 py-2">{{ __('Nomor Plat') }}</th>
                                    <th class="px-4 py-2">{{ __('Tarif Sewa per Hari') }}</th>
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
                                        <td class="px-4 py-2"><button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 open-modal" data-id="{{ $mobil->id }}" data-merek="{{ $mobil->merek }}" data-model="{{ $mobil->model }}">{{ __('Pinjam') }}</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($mobils->isEmpty())
                        <div class="mt-6 text-center text-gray-600 dark:text-gray-400">{{ __('Tidak ada mobil yang tersedia untuk dipinjam.') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="fixed z-10 inset-0 overflow-y-auto hidden" id="modal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div><span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-200" id="modal-title">{{ __('Pesan Mobil') }}</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500 dark:text-gray-300">{{ __('Masukkan Tanggal Mulai dan Tanggal Selesai') }}</p>
                    <form id="peminjaman-form" method="POST" action="{{ route('peminjaman.store') }}">@csrf<input id="mobil_id" name="mobil_id" type="hidden">
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="tanggal_mulai">
                                {{ __('Tanggal Mulai') }}
                            </label>
                            <input class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300" id="tanggal_mulai" name="tanggal_mulai" type="text" placeholder="Pilih tanggal mulai">
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300" for="tanggal_selesai">
                                {{ __('Tanggal Selesai') }}
                            </label>
                            <input class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-300" id="tanggal_selesai" name="tanggal_selesai" type="text" placeholder="Pilih tanggal selesai">
                        </div>
                        <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse"><button class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" type="submit">{{ __('Pesan') }}</button><button class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="close-modal" type="button">{{ __('Batal') }}</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        $(document).ready(function() {
            $('.open-modal').click(function() {
                var mobilId = $(this).data('id');
                var mobilMerek = $(this).data('merek');
                var mobilModel = $(this).data('model');
                $('#modal-title').text('Pesan Mobil: ' + mobilMerek + ' - ' + mobilModel);
                $('#mobil_id').val(mobilId);
                $('#modal').removeClass('hidden');
            });
            $('#close-modal').click(function() {
                $('#modal').addClass('hidden');
            });
        });

        flatpickr("#tanggal_mulai", {
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                let tanggalSelesaiInput = document.getElementById("tanggal_selesai")._flatpickr;
                tanggalSelesaiInput.set("minDate", dateStr);
            }
        });

        flatpickr("#tanggal_selesai", {
            enableTime: false,
            dateFormat: "Y-m-d",
            minDate: new Date(),
        });
    </script>
</x-app-layout>

<x-layout>
    @if (session('success'))
        <div id="success-alert"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="closeAlert()">
                <span class="text-green-500">&times;</span>
            </button>
            <span class="block sm:inline text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <script>
        function closeAlert() {
            document.getElementById('success-alert').remove();
        }
    </script>

    <form action="{{ route('profile') }}" method="GET" class="absolute top-5 left-5">
        @csrf
        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
        </button>
    </form>

    <div class="px-6 py-8 mx-20 my-10 md:h-screen lg:py-0">
        <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
            <h1 class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                Penjadwalan
            </h1>
        </div>
        <div class="flex flex-row">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>

            <p class="text-sm text-gray-500">inputkan jam selesai kuliah atau kegiatan Anda selama 1
                minggu dan pilih 1 hari libur kerja.
            </p>
        </div>
        <div class="flex flex-col items-center w-11/12 md:mt-0 text-sm font-medium relative">
            <div class="w-8/12">
                <form class="space-y-4 md:space-y-6 mt-10 relative" action="{{ route('penjadwalan.store') }}" method="POST">
                    <div class="grid grid-cols-3 gap-20 gap-y-10 mb-10">

                        @csrf
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                        <div class="w-full flex flex-col">
                            <label for="jam_selesai_{{ $loop->index }}"
                                class="font-medium text-sm text-gray-700">{{ $day }}</label>
                                <div class="w-full flex items-center space-x-4">
                                <!-- Input Jam Selesai Kuliah -->
                                <input type="time" id="jam_selesai_{{ $loop->index }}"
                                name="jadwal[{{ $loop->index }}][jam_selesai]"
                                class="w-full p-2 border border-gray-300 rounded-md jam-selesai" required>
                                
                                <!-- Checkbox Hari Libur -->
                                <div class="flex items-center space-x-2">
                                    <input type="checkbox" id="libur_{{ $loop->index }}"
                                    name="jadwal[{{ $loop->index }}][libur]" value="1" class="libur-checkbox">
                                    <label for="libur_{{ $loop->index }}" class="text-sm text-gray-600">Libur</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr class="border-gray-500 mb-6">
                    <button type="submit"
                        class="w-4/12 py-4 flex justify-self-center justify-center bg-[#333533] text-[#EECB6D] rounded-2xl hover:bg-[#EECB6D] hover:text-[#333533] transition-colors duration-200">
                        <p class="text-center text-md">Submit Jadwal Kuliah</p>
                    </button>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Ambil semua checkbox libur dan input jam selesai
                        const checkboxes = document.querySelectorAll('.libur-checkbox');
                        const timeInputs = document.querySelectorAll('.jam-selesai');

                        checkboxes.forEach((checkbox, index) => {
                            checkbox.addEventListener('change', function() {
                                if (checkbox.checked) {
                                    // Jika checkbox libur dicentang, nonaktifkan input jam selesai
                                    timeInputs[index].value = ''; // Hapus nilai jam selesai
                                    timeInputs[index].disabled = true;
                                } else {
                                    // Jika checkbox libur tidak dicentang, aktifkan kembali input jam selesai
                                    timeInputs[index].disabled = false;
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</x-layout>

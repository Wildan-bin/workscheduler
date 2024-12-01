<x-layout>
    <div class="px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
            <h1 class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                Penjadwalan
            </h1>
        </div>
        <div class="grid grid-cols-2 gap-4 md:mt-0 text-sm font-medium relative">
            <div class="w-[300px] max-w-sm">
                <div class="flex flex-row">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-12 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>

                    <p class="text-xs text-gray-500">inputkan jam selesai kuliah atau kegiatan Anda selama 7 hari/1
                        minggu.
                    </p>
                </div>
                <form class="space-y-4 md:space-y-6" action="{{ route('penjadwalan.store') }}" method="POST">
                    @csrf

                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                        <div class="w-full flex flex-col">
                            <label for="jam_selesai_{{ $loop->index }}"
                                class="font-medium text-sm text-gray-700">{{ $day }}</label>
                            <div class="w-full flex items-center space-x-4">
                                <!-- Input Jam Selesai Kuliah -->
                                <input type="time" id="jam_selesai_{{ $loop->index }}"
                                    name="jadwal[{{ $loop->index }}][jam_selesai]"
                                    class="w-full p-2 border border-gray-300 rounded-md" required>
                            </div>
                        </div>
                    @endforeach

                    <button type="submit" class="w-full py-2 bg-[#333533] text-[#EECB6D] rounded-md">Submit
                        Jadwal
                        Kuliah</button>
                </form>

            </div>
        </div>
    </div>
</x-layout>

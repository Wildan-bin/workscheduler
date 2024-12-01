<x-layout>
    <form action="{{ route('dashboard') }}" method="GET" class="absolute top-5 left-5">
        @csrf
        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
        </button>
    </form>

    <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-transparent mb-5 md:mt-0 sm:max-w-md xl:p-0">
            <h1 class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                Buat Jadwal Pegawai
            </h1>
            <div class="flex flex-row mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-12 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>

                <p class="text-xs text-gray-500">List di bawah merupakan Jam selesai kuliah yang telah diinputkan
                    pegawai
                    untuk dibuatkan jadwal kerja.
                </p>
            </div>
        </div>
        <div id="jadwalkuliah" class="w-full bg-transparent md:mt-0 sm:max-w-md xl:p-0">
            @foreach ($pegawais as $pegawai)
                <div id="pegawai"
                    class="bg-[#FDFAEF] border-2 border-[#333533] rounded-xl shadow-[2px_3px_10px_1px_#3d3d3d] mb-4">
                    <div id="nama" class="flex flex-col px-2 py-3 relative border-b-2 border-[#333533] ">
                        <!-- Tampilkan nama pegawai -->
                        <p class="text-sm font-semibold">{{ $pegawai->nama }}</p>
                    </div>
                    <div id="hari" class="px-2 py-2 border-b-2 border-[#333533]">
                        <div class="grid grid-cols-2 gap-4 w-full md:mt-0 text-sm font-medium relative">
                            @foreach ($pegawai->jadwalKuliah as $jadwal)
                                <div class="mb-1">
                                    <!-- Tampilkan hari dan jam selesai kuliah -->
                                    <p class="flex flex-col text-sm">
                                        <span class="text-[#333533] text-md font-semibold">{{ $jadwal->hari }}</span>
                                        <span
                                            class="text-gray-700 text-sm font-medium">{{ $jadwal->jam_selesai }}</span>
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <form class="py-2 px-2" action="{{ route('jadwalKerja.buat') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}">
                        <button type="submit"
                            class="w-auto py-2 bg-[#333533] text-[#EECB6D] font-normal rounded-xl text-xs px-4 text-center">
                            Buat Jadwal
                        </button>
                    </form>
                </div>
            @endforeach
        </div>


    </div>
</x-layout>

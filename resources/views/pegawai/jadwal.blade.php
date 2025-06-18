<x-layout>
    <div class="w-full rounded-2xl shadow-md p-6 px-20">
        <!-- Header -->
        <form action="{{ route('profile') }}" method="GET" class="absolute top-5 left-5">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </button>
        </form>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Jadwal Pegawai</h1>

        <!-- Date Input Styled as Button -->
        <div class="relative mt-2 mb-6 text-left">
            <!-- Form untuk memilih bulan -->
            <form method="GET" action="{{ route('jadwalkerja.index') }}">
                <input type="month" name="month" id="monthInput"
                    class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-lg appearance-none w-auto text-left cursor-pointer focus:outline-none"
                    value="{{ $selectedMonth }}" onchange="this.form.submit()" />
            </form>
        </div>

        <!-- Schedule List -->
        <div id="scheduleList" class="w-full grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-7 gap-12 gap-y-8">
            <!-- Initial schedule, will be updated via JavaScript -->
            @foreach ($pegawais as $pegawai)
                @foreach ($pegawai->jadwalKerja as $jadwal)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">
                            {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, j F Y') }}
                        </h3>
                        <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                            <p class="font-medium">{{ $pegawai->nama }}</p>
                            <p class="font-medium"></p>
                            @if ($jadwal->jam_selesai === '00:00:00')
                                <span class="text-red-500 text-sm">Libur Kerja</span>
                            @else
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }} -
                                    {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</x-layout>

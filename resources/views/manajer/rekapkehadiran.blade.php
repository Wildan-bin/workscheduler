<x-layout>
    <div class="p-6 px-6 md:px-20">

        <!-- Header -->
        <form action="{{ route('dashboard') }}" method="GET" class="absolute top-5 left-5">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </button>
        </form>

        <!-- Title -->
        <div class="flex justify-between items-center w-full max-w-xs mb-4">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
                <h1 class="text-4xl font-bold leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Rekap Kehadiran
                </h1>
                <!-- Filter Pegawai -->
                <form method="GET" action="{{ route('adminrekapkehadiran') }}" class="mb-4">
                    <select name="pegawai_id" id="pegawaiSelect"
                        class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-lg appearance-none cursor-pointer focus:outline-none"
                        onchange="this.form.submit()">
                        <option value="">Semua Pegawai</option>
                        @foreach ($allPegawais as $pegawaiOption)
                        <option value="{{ $pegawaiOption->id }}" class="{{ $pegawaiOption->jabatan === 'admin' ? 'hidden' : '' }}"
                            {{ (request('pegawai_id') == $pegawaiOption->id) ? 'selected' : '' }}>
                            {{ $pegawaiOption->nama }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        @if ($kehadiran->isEmpty())
            <p class="text-gray-500">Belum ada data kehadiran.</p>
        @else
            <div class="overflow-x-auto">
                <table class="table-auto border-collapse w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Nama Pegawai</th>
                            <th class="py-3 px-6 text-left">Tanggal</th>
                            <!-- <th class="py-3 px-6 text-left">Jam Masuk</th>
                            <th class="py-3 px-6 text-left">Jam Keluar</th> -->
                            <th class="py-3 px-6 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @foreach ($kehadiran as $data)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6">{{ $data->pegawai->nama ?? 'N/A' }}</td>
                                <td class="py-3 px-6">
                                    {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, j F Y') }}</td>
                                <!-- <td class="py-3 px-6">{{ \Carbon\Carbon::parse($data->jam_masuk)->format('H:i') }}</td>
                                <td class="py-3 px-6">
                                    {{ $data->jam_keluar ? \Carbon\Carbon::parse($data->jam_keluar)->format('H:i') : '-' }}
                                </td> -->
                                <td class="py-3 px-6">
                                    <span class="{{ $data->status_kehadiran === 'Hadir' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $data->status_kehadiran }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layout>

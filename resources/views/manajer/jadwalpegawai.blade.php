<x-layout>
    <div class="w-full rounded-2xl shadow-md p-6 px-10 lg:px-20">
        <!-- Header -->
        <form action="{{ route('dashboard') }}" method="GET" class="absolute top-5 left-5">
            @csrf
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </button>
        </form>

        <!-- Title -->
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Jadwal Pegawai</h1>

        <!-- Date Input Styled as Button -->
        <div class="relative mt-2 mb-6 text-left">
            <!-- Form untuk memilih bulan dan pegawai -->
            <form method="GET" action="{{ route('jadwalpegawai.index') }}" class="flex flex-col lg:flex-row gap-2 lg:items-center w-6/12 md:w-4/12">
                <select name="pegawai_id" id="pegawaiSelect"
                    class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-lg appearance-none cursor-pointer focus:outline-none"
                    onchange="this.form.submit()">
                    <option value="">Semua Pegawai</option>
                    @foreach ($allPegawais as $pegawaiOption)
                    <option value="{{ $pegawaiOption->id }}" class="{{ $pegawaiOption->jabatan === 'admin' ? 'hidden' : '' }}"
                        {{ $selectedPegawaiId == $pegawaiOption->id ? 'selected' : '' }}>
                        {{ $pegawaiOption->nama }}
                    </option>
                    @endforeach
                </select>
                <input type="month" name="month" id="monthInput"
                    class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-lg appearance-none w-auto text-left cursor-pointer focus:outline-none"
                    value="{{ $selectedMonth }}" onchange="this.form.submit()" />
            </form>
        </div>

        <!-- Schedule List -->
        <div id="scheduleList" class="w-full grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 xl:grid-cols-7 gap-4 lg:gap-12 lg:gap-y-8">
            <!-- Jadwal akan di-update oleh JavaScript -->

            @foreach ($pegawais as $pegawai)
            @foreach ($pegawai->jadwalKerja as $jadwal)
            <div>
                <h3 class="text-sm lg:text-lg font-semibold text-gray-700">
                    {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, j F Y') }}
                </h3>
                <div class="relative bg-gray-400 text-white p-3 rounded-2xl mt-1">
                    <p class="font-medium text-sm lg:text-lg">{{ $pegawai->nama }}</p>

                    @if ($jadwal->jam_selesai === '00:00:00')
                    <span class="text-red-500 text-sm">Libur Kerja</span>
                    @else
                    <p class="text-sm">
                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H.i') }} -
                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H.i') }}
                    </p>
                    @php
                    $isPresensiDone = isset($presensiMap[$pegawai->id]) && isset($presensiMap[$pegawai->id][$jadwal->tanggal]);
                    @endphp
                    <button
                        @if($isPresensiDone) disabled class="bg-gray-900 text-white py-1 px-3 rounded-lg mt-2 cursor-not-allowed text-sm lg:text-lg"
                        @else onclick="openPresenceModal('{{ $pegawai->id }}', '{{ $jadwal->tanggal }}')" class="bg-blue-500 text-white py-1 px-3 rounded-lg mt-2 hover:bg-blue-600 text-sm lg:text-lg" @endif>
                        @if($isPresensiDone)
                        Selesai Presensi
                        @else
                        Presensi
                        @endif
                    </button>
                    <!-- Tombol Edit -->
                    <button
                        class="absolute right-[-5px] top-[-5px] bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600"
                        onclick="openEditModal('{{ $jadwal->id }}', '{{ $jadwal->jam_mulai }}')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>

    <!-- Modal untuk Presensi -->
    <div id="presenceModal" class="fixed z-50 inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Presensi Pegawai</h2>
            <form action="{{ route('jadwalpegawai.savePresence') }}" method="POST">
                @csrf
                <input type="hidden" id="pegawaiId" name="pegawai_id">
                <input type="hidden" id="tanggalPresensi" name="tanggal">

                <label for="status" class="block text-sm font-medium text-gray-600 mb-2">Status Kehadiran:</label>
                <select id="status" name="status"
                    class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alpha">Alpha</option>
                </select>

                <div class="mt-4 flex justify-end">
                    <button type="button" onclick="closePresenceModal()"
                        class="bg-gray-400 text-white py-1 px-4 rounded-lg mr-2 hover:bg-gray-500">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-500 text-white py-1 px-4 rounded-lg hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Jam Masuk -->
    <div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-lg font-semibold mb-4">Edit Jam Masuk</h2>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="jadwalId" name="id">
                <label class="block mb-2">Jam Masuk:</label>
                <input type="time" id="jamMasukInput" name="jam_mulai" class="w-full p-2 border rounded mb-4" required>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        // Function to open the modal and set the pegawai ID and tanggal
        function openPresenceModal(pegawaiId, tanggal) {
            document.getElementById('pegawaiId').value = pegawaiId;
            document.getElementById('tanggalPresensi').value = tanggal;
            document.getElementById('presenceModal').classList.remove('hidden');
        }

        // Function to close the modal
        function closePresenceModal() {
            document.getElementById('presenceModal').classList.add('hidden');
        }

        // Function to update schedule based on selected month
        function updateSchedule() {
            const monthInput = document.getElementById("monthInput").value;
            const scheduleList = document.getElementById("scheduleList");
            scheduleList.innerHTML = ""; // Clear the current list

            if (schedules[monthInput]) {
                // Populate schedule for the selected month
                schedules[monthInput].forEach(schedule => {
                    const scheduleItem = document.createElement("div");
                    scheduleItem.innerHTML = `
                        <h3 class="text-lg font-semibold text-gray-700">${schedule.date}</h3>
                        <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                            <p class="font-medium">${schedule.name}</p>
                            <p class="text-sm">${schedule.time}</p>
                            <button onclick="openPresenceModal()" class="bg-blue-500 text-white py-1 px-3 rounded-lg mt-2 hover:bg-blue-600">
                                Presensi
                            </button>
                        </div>
                    `;
                    scheduleList.appendChild(scheduleItem);
                });
            } else {
                // Display message if no schedule is available for the selected month
                scheduleList.innerHTML = "<p class='text-center text-gray-600'>Tidak ada jadwal untuk bulan ini.</p>";
            }
        }

        function openEditModal(id, jamMasuk) {
            document.getElementById('jadwalId').value = id;
            document.getElementById('jamMasukInput').value = jamMasuk;
            document.getElementById('editForm').action = `/admin/jadwalpegawai/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('flex');
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</x-layout>
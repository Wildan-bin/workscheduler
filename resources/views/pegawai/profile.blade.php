<x-layout>
    <div class="flex flex-col items-center justify-center p-4">
        <div class="flex flex-row">
            <form action="{{ route('logout') }}" method="POST" class="absolute top-5 left-5">
                @csrf
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                        <path fill-rule="evenodd"
                            d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
            <h1 class="absolute top-5 right-5 font-semibold text-sm">Halo, {{ explode(' ', Auth::user()->nama)[0] }}!
            </h1>
        </div>
        <!-- Profile Header with Profile Text and Logout Icon (Outside Profile Card) -->
        <div class="flex justify-between items-center w-full max-w-xs mb-4">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
                <h1 class="text-4xl font-bold leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Profile
                </h1>
            </div>
        </div>

        <!-- Profile Card (Taller than Width) -->
        <div class="w-full max-w-xs h-[20rem] bg-[#EECB6D] rounded-[20px] shadow-lg p-6 mb-4">
            <!-- Profile Content -->
            <div class="rounded-lg p-6 flex flex-col items-center">
                <!-- Profile Icon -->
                <div class="w-24 h-24 bg-blackProfile rounded-full mb-4 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <!-- Profile Information with Adjusted Spacing -->
                <p class="text-lg font-semibold text-gray-800 text-center mb-2">{{ Auth::user()->nama }}</p>
                <p class="text-sm text-gray-600 text-center mb-2">{{ Auth::user()->email }}</p>
                <p class="text-sm text-gray-600 text-center">{{ Auth::user()->jabatan }}</p>
            </div>
        </div>

        <!-- Buttons (Outside the Profile Card, Aligned with Card Width) -->
        <div class="flex w-full max-w-xs space-x-2">
            <!-- Jadwal Pegawai Button -->
            <a href="{{ route('penjadwalan') }}"
                class="flex-1 bg-[#333533] font-regular text-[#EECB6D] text-xs py-3 px-4 rounded-xl shadow-md text-center hover:bg-[#EECB6D] hover:text-[#333533] transition-colors duration-200">
                Input Jadwal
            </a>
            <!-- Jadwal Pegawai Button -->
            <a href="{{ url('pegawai/jadwal') }}"
                class="flex-1 bg-[#333533] font-regular text-[#EECB6D] text-xs py-3 px-4 rounded-xl shadow-md text-center hover:bg-[#EECB6D] hover:text-[#333533] transition-colors duration-200">
                Jadwal Pegawai
            </a>
            {{-- Rekap Kehadiran Button --}}
            <a href="{{ url('pegawai/rekapkehadiran') }}"
                class="flex-1 bg-[#333533] font-regular text-[#EECB6D] text-xs py-3 px-4 rounded-xl shadow-md text-center hover:bg-[#EECB6D] hover:text-[#333533] transition-colors duration-200">
                Rekap Kehadiran
            </a>
        </div>
    </div>
</x-layout>

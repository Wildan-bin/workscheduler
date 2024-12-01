<x-layout>
    <form action="{{ route('jadwalpegawai') }}" method="GET" class="absolute top-5 left-5">
        @csrf
        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
            </svg>
        </button>
    </form>

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
            <h1 class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                Jadwal Pegawai
            </h1>
            <a type="submit " href="{{ route('jadwalkuliah') }}"
                class="text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-3xl text-xs px-5 py-2.5 text-center shadow-[2px_3px_10px_1px_#3d3d3d]">
                Buat Jadwal
            </a>
        </div>

    </div>
</x-layout>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Katalog Produk</title>
    @vite('resources/css/app.css')
    <!-- Tambahkan ini di dalam <head> HTML -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FDFAEF]">
    <div class="flex flex-row">
        <form action="{{ route('dashboard') }}" method="GET" class="absolute top-5 left-5">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </button>
        </form>
        <h1 class="absolute top-5 right-5 font-semibold text-sm">Halo, {{ Auth::user()->name }}!</h1>
    </div>
    <section class="bg-transparent pt-[10%] lg:pt-5 font-[Poppins]">
        <div class="px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0 relative">
                <h1
                    class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Katalog Produk
                </h1>
                <a type="submit "
                    class="w-2/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-xl text-xs px-1 py-1.5 text-center absolute">
                    Lihat Katalog
                </a>
            </div>
        </div>
    </section>
    <section class="py-10 md:py-12 lg:py-14">
        <div class="container mx-auto">
            <div class="p-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 lg:gap-10">
                <div class="bg-[#EECB6D] rounded-3xl shadow-lg p-4 lg:p-6 lg:px-12 flex items-center">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/110/MTA-173935946/erigo_erigo-parfume-jkt48-tranquil_full01.jpg"
                        alt="Produk 1" class="w-24 h-24 object-cover rounded-2xl mr-3 md:mr-5 lg:mr-6">
                    <div class="w-1/2 ml-2 ">
                        <h3 class="text-xl font-bold lg:text-xl">Nama Produk 1</h3>
                        <p class="text-gray-600 text-xs md:text-sm lg:text-md">Deskripsi singkat produk 1.</p>
                    </div>
                </div>
                <div class="bg-[#EECB6D] rounded-3xl shadow-lg p-4 lg:p-6 md:px-10 lg:px-12 flex items-center">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/110/MTA-173935946/erigo_erigo-parfume-jkt48-tranquil_full01.jpg"
                        alt="Produk 2" class="w-24 h-24 object-cover rounded-2xl mr-3 md:mr-5 lg:mr-6">
                    <div class="w-1/2 ml-2 ">
                        <h3 class="text-xl font-bold lg:text-xl">Nama Produk 2</h3>
                        <p class="text-gray-600 text-xs md:text-sm lg:text-md">Deskripsi singkat produk 2.</p>
                    </div>
                </div>
                <div class="bg-[#EECB6D] rounded-3xl shadow-lg p-4 md:p-5 lg:p-6 md:px-10 lg:px-12 flex items-center">
                    <img src="https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/110/MTA-173935946/erigo_erigo-parfume-jkt48-tranquil_full01.jpg"
                        alt="Produk 3" class="w-24 h-24 object-cover rounded-2xl mr-3 md:mr-5 lg:mr-6">
                    <div class="w-1/2 ml-2 ">
                        <h3 class="text-xl font-bold lg:text-xl">Nama Produk 3</h3>
                        <p class="text-gray-600 text-xs md:text-sm lg:text-md">Deskripsi singkat produk 3.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tambahkan lebih banyak produk sesuai kebutuhan -->
    </section>
</body>

</html>

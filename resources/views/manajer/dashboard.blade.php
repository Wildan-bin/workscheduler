<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>
    @vite('resources/css/app.css')
    <!-- Tambahkan ini di dalam <head> HTML -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="bg-amber-50">
    <div class="flex flex-row">
        <form action="{{ route('logout') }}" method="POST" class="absolute top-5 left-5">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-8">
                    <path fill-rule="evenodd"
                        d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </form>
        <h1 class="absolute top-5 right-5 font-semibold text-sm">Halo, {{ Auth::user()->name }}!</h1>
    </div>
    <section class="bg-transparent pt-[30%] lg:pt-5 font-[Poppins]">
        <div class="px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0">
                <h1
                    class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Dashboard
                </h1>
            </div>
            <div class="grid grid-cols-2 gap-4 w-full md:mt-0 text-sm font-medium relative">
                <div
                    class="flex justify-center w-full bg-white rounded-xl shadow border-2 border-amber-400 md:mt-0 p-0 xl:p-0 h-40 relative shadow-[1px_3px_3px_4px_#c7c7c7]">
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                        <h1 class="pt-2 mb-12  text-center">Katalog Produk</h1>
                    </div>
                    <a type="submit " href="{{ route('catalog') }}"
                        class="w-4/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-xs px-1 py-1.5 text-center absolute bottom-4 ">
                        Lihat
                    </a>
                </div>
                <div
                    class="flex justify-center w-full bg-white rounded-xl shadow border-2 border-amber-400 md:mt-0 p-0 xl:p-0 h-40 relative shadow-[1px_3px_3px_4px_#c7c7c7]    ">
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <h1 class="pt-2 mb-12  text-center">Akun Sistem</h1>
                    </div>
                    <a type="submit "
                        class="w-4/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-xs px-1 py-1.5 text-center absolute bottom-4 ">
                        Lihat
                    </a>
                </div>
                <div
                    class="flex justify-center w-full bg-white rounded-xl shadow border-2 border-amber-400 md:mt-0 p-0 xl:p-0 h-40 relative shadow-[1px_3px_3px_4px_#c7c7c7]    ">
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                        </svg>

                        <h1 class="pt-2 mb-12  text-center">Jadwal Pegawai</h1>
                    </div>
                    <a type="submit "
                        class="w-4/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-xs px-1 py-1.5 text-center absolute bottom-4 ">
                        Lihat
                    </a>
                </div>
                <div
                    class="flex justify-center w-full bg-white rounded-xl shadow border-2 border-amber-400 md:mt-0 p-0 xl:p-0 h-40 relative shadow-[1px_3px_3px_4px_#c7c7c7]    ">
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>

                        <h1 class="pt-2 mb-12 text-center">Kehadiran Pegawai</h1>
                    </div>
                    <a type="submit "
                        class="w-4/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-xs px-1 py-1.5 text-center absolute bottom-4 ">
                        Lihat
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>

</html>

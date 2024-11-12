<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <!-- Tambahkan ini di dalam <head> HTML -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- HTML -->
    <div class="min-h-screen bg-[#F6F2E9] p-6 flex flex-col items-center">
        <!-- Header -->
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-4">
            <div class="flex items-center justify-between">
                <button class="text-gray-600 text-lg">&larr;</button>
                <span class="text-gray-600 text-sm">Halo Pegawai</span> 
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                    </svg>
                </div>
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl font-bold mt-4">Jadwal Pegawai</h1>
            
            <!-- Month Date Input -->
            <div class="mt-2">
                <input type="date" class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-md">
            </div>

            <!-- Schedule List -->
            <div class="mt-6 space-y-4">
                <!-- Schedule Item -->
                <div>
                    <h3 class="text-lg font-semibold">Selasa, 9 Oktober 2024</h3>
                    <div class="bg-gray-400 text-white p-3 rounded-md mt-1">
                        <p class="font-medium">Rahmalia Agista</p>
                        <p class="text-sm">07.00 - 13.00 WIB</p>
                    </div>
                </div>
                
                <!-- Repeat for other days -->
                <div>
                    <h3 class="text-lg font-semibold">Rabu, 10 Oktober 2024</h3>
                    <div class="bg-gray-400 text-white p-3 rounded-md mt-1">
                        <p class="font-medium">Rahmalia Agista</p>
                        <p class="text-sm">13.00 - 18.00 WIB</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Kamis, 11 Oktober 2024</h3>
                    <div class="bg-gray-400 text-white p-3 rounded-md mt-1">
                        <p class="font-medium">Rahmalia Agista</p>
                        <p class="text-sm">18.00 - 21.00 WIB</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Jumat, 12 Oktober 2024</h3>
                    <div class="bg-gray-400 text-white p-3 rounded-md mt-1">
                        <p class="font-medium">Rahmalia Agista</p>
                        <p class="text-sm">12.00 - 15.00 WIB</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

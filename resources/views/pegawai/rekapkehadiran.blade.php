<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Kehadiran</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-[#F6F2E9] p-6 flex flex-col items-center">
    <!-- Container Utama -->
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <button class="text-gray-600 text-lg">&larr;</button>
            <span class="text-gray-600 text-sm">Halo Pegawai</span>
            <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                </svg>
            </div>
        </div>

        <!-- Judul Halaman -->
        <h1 class="text-3xl font-bold mt-4">Rekap Kehadiran</h1>
        
        <!-- Input Tanggal -->
        <div class="mt-2">
            <input type="date" class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-md">
        </div>

        <!-- Grid Kehadiran -->
        <div class="grid grid-cols-3 gap-3 mt-6 text-center">
            <!-- Item Kehadiran -->
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">1</div>
                <div class="text-sm mt-1">Hadir</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">2</div>
                <div class="text-sm mt-1">Hadir</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">3</div>
                <div class="text-sm mt-1">Izin</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">4</div>
                <div class="text-sm mt-1">Hadir</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">5</div>
                <div class="text-sm mt-1">Hadir</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">6</div>
                <div class="text-sm mt-1">Izin</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">7</div>
                <div class="text-sm mt-1">Hadir</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">8</div>
                <div class="text-sm mt-1">Absen</div>
            </div>
            <div class="p-4 bg-gray-200 rounded-lg">
                <div class="text-xl font-bold">9</div>
                <div class="text-sm mt-1">Hadir</div>
            </div>
            <!-- Tambahkan tanggal kehadiran lainnya sesuai kebutuhan -->
        </div>
    </div>
</body>
</html>

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
    <div class="min-h-screen bg-cream flex items-center justify-center p-4">
        <!-- Profile Card -->
        <div class="w-[15] max-w-sm bg-[#eecc6db0] rounded-[20px] shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Profile</h2>
            <div class="bg-yellowCustom rounded-lg p-6 flex flex-col items-center mb-4">
                <!-- Profile Icon -->
                <div class="w-24 h-24 bg-blackProfile rounded-full mb-4 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <!-- Profile Information -->
                <p class="text-lg font-medium text-gray-800 text-center">Rahmalia Agista Putri</p>
                <p class="text-sm text-gray-600 text-center">ID : 230535610164</p>
                <p class="text-sm text-gray-600 text-center">No. Telp : 082335932582</p>
            </div>
            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                <!-- Jadwal Pegawai Button -->
                <a href="http://127.0.0.1:8000/pegawai/jadwal" class="flex-1 bg-[#CD9C20] font-semibold py-2 rounded-lg shadow-md text-center hover:bg-yellow-500 transition-colors duration-200">
                    Jadwal Pegawai
                </a>
                <!-- Rekap Kehadiran Button -->
                <a href="http://127.0.0.1:8000/pegawai/rekapkehadiran" class="flex-1 bg-[#CD9C20] font-semibold py-2 rounded-lg shadow-md text-center hover:bg-yellow-500 transition-colors duration-200">
                    Rekap Kehadiran
                </a>
            </div>
        </div>
    </div>
</body>
</html>

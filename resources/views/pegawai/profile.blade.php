<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Container -->
    <div class="min-h-screen bg-cream flex flex-col items-center justify-center p-4">
        <!-- Profile Header with Profile Text and Logout Icon (Outside Profile Card) -->
        <div class="flex justify-between items-center w-full max-w-xs mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Profile</h2>
            <!-- Logout Button -->
            <a href="/logout" class="text-gray-800 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10 9v6h5l-1.5-1.5H10v-3h3.5L15 9h-5zM4 19h11v-2H4V7h11V5H4c-1.11 0-2 .9-2 2v10c0 1.1.89 2 2 2z"/>
                </svg>
            </a>
        </div>

        <!-- Profile Card (Taller than Width) -->
        <div class="w-full max-w-xs h-[24rem] bg-[#eecc6db0] rounded-[20px] shadow-lg p-6 mb-4">
            <!-- Profile Content -->
            <div class="bg-yellowCustom rounded-lg p-6 flex flex-col items-center mb-4">
                <!-- Profile Icon -->
                <div class="w-24 h-24 bg-blackProfile rounded-full mb-4 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <!-- Profile Information with Adjusted Spacing -->
                <p class="text-lg font-semibold text-gray-800 text-center mb-2">Rahmalia Agista Putri</p>
                <p class="text-sm text-gray-600 text-center mb-2">ID : 230535610164</p>
                <p class="text-sm text-gray-600 text-center">No. Telp : 082335932582</p>
            </div>
        </div>

        <!-- Buttons (Outside the Profile Card, Aligned with Card Width) -->
        <div class="flex w-full max-w-xs space-x-4">
            <!-- Jadwal Pegawai Button -->
            <a href="http://127.0.0.1:8000/pegawai/jadwal" class="flex-1 bg-[#CD9C20] font-semibold text-white py-2 px-4 rounded-2xl shadow-md text-center hover:bg-yellow-500 transition-colors duration-200 text-lg">
                Jadwal Pegawai
            </a>
            <!-- Rekap Kehadiran Button -->
            <a href="http://127.0.0.1:8000/pegawai/rekapkehadiran" class="flex-1 bg-[#CD9C20] font-semibold text-white py-2 px-4 rounded-2xl shadow-md text-center hover:bg-yellow-500 transition-colors duration-200 text-lg">
                Rekap Kehadiran
            </a>
        </div>
    </div>
</body>
</html>

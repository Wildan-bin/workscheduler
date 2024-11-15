<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-yellow-50 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md mx-auto p-6 bg-[#f2ecdd] shadow-lg rounded-lg">
        <!-- Bagian Atas -->
        <div class="flex items-center justify-between mb-4">
            <!-- Tombol Kembali -->
            <a href="{{ url('http://127.0.0.1:8000/pegawai/profile') }}" class="text-gray-600 text-2xl">
                ←
            </a>
            <!-- Profil Admin -->
            <div class="flex items-center space-x-2">
                <span class="text-gray-600">Halo Admin</span>
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <img src="path-to-icon" alt="Admin" class="w-6 h-6 rounded-full">
                </div>
            </div>
        </div>
        
        <!-- Judul Kehadiran Pegawai -->
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Kehadiran Pegawai</h1>
        </div>

        <!-- Input Bulan -->
        <form method="GET" class="flex items-center mb-4">
            <input type="month" name="date" class="bg-yellow-200 text-[#000000] font-semibold py-1 px-3 rounded focus:outline-none mr-auto" 
                   value="<?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : date('Y-m'); ?>" onchange="this.form.submit()">
        </form>

        <!-- Nama Pegawai -->
        <div class="mb-4 text-left">
            <?php
                $employeeName = isset($_GET['employee']) ? htmlspecialchars($_GET['employee']) : 'Natanael';
                echo "<span class='text-[#333533] font-medium'>$employeeName</span>";
            ?>
        </div>
        
        <!-- Tanggal dan Kehadiran -->
        <div class="grid grid-cols-3 gap-4 justify-items-center items-center">
            <?php
                // Mendapatkan bulan dan tahun dari input
                $selectedDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m');
                list($year, $month) = explode('-', $selectedDate);

                // Menghitung jumlah hari dalam bulan yang dipilih
                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

                // Contoh data kehadiran
                $attendance = [
                    1 => 'Hadir', 2 => 'Hadir', 3 => 'Izin',
                    4 => 'Hadir', 5 => 'Hadir', 6 => 'Izin',
                    7 => 'Hadir', 8 => 'Absen', 9 => 'Hadir',
                    10 => 'Absen', 11 => 'Hadir', 12 => 'Hadir',
                    // Tambahkan data lainnya sesuai kebutuhan
                ];

                // Loop untuk menampilkan tanggal dan status kehadiran sesuai bulan yang dipilih
                for ($day = 1; $day <= $daysInMonth; $day++) {
                    if (isset($attendance[$day])) {
                        $status = $attendance[$day];
                        $statusColor = $status == 'Hadir' ? 'text-[#2d3748]' : ($status == 'Izin' ? 'text-[#865c02]' : 'text-[#bb2929]');
                    } else {
                        $status = 'N/A'; // Status default jika data tidak ada
                        $statusColor = 'text-gray-500';
                    }
                    echo "<div class='flex flex-col w-24 h-30 items-center p-6 rounded-2xl bg-white shadow $statusColor'>";
                    echo "<span class='text-lg font-bold'>$day</span>";
                    echo "<span class='text-sm'>$status</span>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>

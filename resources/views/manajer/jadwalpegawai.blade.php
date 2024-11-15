<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Pegawai</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f8f5e9] font-sans">
    <div class="container mx-auto py-10 px-4">
        <!-- Back Button and Profile Section -->
        <div class="flex items-center justify-between mb-2">
            <button onclick="history.back()" class="text-[#7d7d7d] mr-4 text-2xl">←</button>
            
            <!-- Profile Section with Halo Admin -->
            <div class="flex items-center space-x-2">
                <span class="text-[#7d7d7d]">Halo Admin</span>
                <div class="w-8 h-8 bg-[#d1d1d1] rounded-full flex items-center justify-center">
                    <img src="path-to-icon" alt="Admin" class="w-6 h-6 rounded-full">
                </div>
            </div>
        </div>
        
        <!-- Title Jadwal Pegawai -->
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-[#3e3e3e]">Jadwal Pegawai</h1>
        </div>

        <!-- Date Picker for Month Selection -->
        <form method="GET" class="flex justify-start mb-6">
            <input type="month" name="month" class="text-sm bg-[#EECB6D] text-[#000000] font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-[#FFBF00]"
                   value="<?php echo isset($_GET['month']) ? htmlspecialchars($_GET['month']) : date('Y-m'); ?>" onchange="this.form.submit()">
        </form>

        <!-- Schedule List -->
        <div class="space-y-8">
            <?php
                // Get selected month and year from the input
                $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
                list($year, $month) = explode('-', $selectedMonth);

                // Example schedule data (date, name, time)
                $schedules = [
                    '2024-10-09' => [
                        ['name' => 'Pegawai D', 'time' => '07.00 - 13.00 WIB'],
                        ['name' => 'Pegawai B', 'time' => '13.00 - 18.00 WIB'],
                        ['name' => 'Pegawai A', 'time' => '18.00 - 21.00 WIB'],
                    ],
                    '2024-10-10' => [
                        ['name' => 'Pegawai C', 'time' => '08.00 - 14.00 WIB'],
                        ['name' => 'Pegawai D', 'time' => '14.00 - 19.00 WIB'],
                    ],
                    // Add more dates and schedules as needed
                ];

                $foundSchedules = false; // Flag to check if any schedule is found for the selected month

                // Filter and display schedules for the selected month
                foreach ($schedules as $date => $daySchedules) {
                    $scheduleDate = new DateTime($date);
                    if ($scheduleDate->format('Y-m') === "$year-$month") {
                        if (!$foundSchedules) {
                            $foundSchedules = true; // Mark as found when displaying the first schedule
                        }
                        echo "<div>";
                        echo "<h2 class='text-xl font-semibold text-[#4a4a4a]'>" . $scheduleDate->format('l, j F Y') . "</h2>";
                        echo "<div class='space-y-4 mt-2'>";
                        foreach ($daySchedules as $schedule) {
                            echo "
                            <div class='flex justify-between items-center bg-[#e5e5e5] p-4 rounded-md shadow cursor-pointer'>
                                <div onclick=\"openEditScheduleModal('{$schedule['name']}', '{$schedule['time']}')\" class='flex-grow'>
                                    <p class='font-medium text-[#3e3e3e]'>{$schedule['name']}</p>
                                    <p class='text-sm text-[#7d7d7d]'>{$schedule['time']}</p>
                                </div>
                                <button onclick=\"openAttendanceModal('{$schedule['name']}')\" class='bg-[#333333] text-[#FFFFFF] px-4 py-2 rounded-md'>Presensi</button>
                            </div>";
                        }
                        echo "</div></div>";
                    }
                }

                // If no schedules are found, display the message
                if (!$foundSchedules) {
                    echo "<p class='text-center text-lg font-medium text-[#4a4a4a]'>Tidak ada jadwal pegawai pada bulan ini</p>";
                }
            ?>
        </div>
    </div>

    <!-- Attendance Modal -->
    <div id="attendanceModal" class="fixed inset-0 bg-[#00000080] flex justify-center items-center hidden">
        <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg w-80 max-w-md relative">
            <button onclick="closeAttendanceModal()" class="absolute top-2 right-2 text-[#7d7d7d] text-2xl">&times;</button>
            <h2 class="text-lg font-semibold text-[#3e3e3e] mb-2">Presensi</h2>
            <p id="employeeName" class="text-sm font-medium text-[#4a4a4a] mb-4">Pegawai 'D'</p>

            <!-- Attendance Options -->
            <div class="space-y-2 text-[#FFD700]">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2" id="hadir"> Hadir
                </label>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2" id="sakit"> Sakit
                </label>
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2" id="izin"> Izin
                </label>
            </div>

            <!-- Save Button -->
            <button onclick="saveAttendance()" class="w-full mt-5 bg-[#333333] text-[#FFD700] py-2 rounded-md">Simpan</button>
        </div>
    </div>

    <!-- Edit Schedule Modal -->
    <div id="editScheduleModal" class="fixed inset-0 bg-[#00000080] flex justify-center items-center hidden">
        <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg w-80 max-w-md relative">
            <button onclick="closeEditScheduleModal()" class="absolute top-2 right-2 text-[#7d7d7d] text-2xl">&times;</button>
            <h2 class="text-lg font-semibold text-[#3e3e3e] mb-2">Ubah Jadwal Pegawai</h2>
            <p id="editEmployeeName" class="text-sm font-medium text-[#4a4a4a] mb-4">Pegawai 'D'</p>

            <!-- Input Fields for Jam Masuk and Jam Selesai -->
            <label class="block text-sm font-medium text-[#4a4a4a] mb-1">Jam Masuk</label>
            <input type="text" id="jamMasuk" placeholder="Input Jam Masuk" class="w-full mb-3 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#FFD700]" />

            <label class="block text-sm font-medium text-[#4a4a4a] mb-1">Jam Selesai</label>
            <input type="text" id="jamSelesai" placeholder="Input Jam Selesai" class="w-full mb-5 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#FFD700]" />

            <!-- Save Button -->
            <button onclick="saveSchedule()" class="w-full bg-[#333333] text-[#FFD700] py-2 rounded-md">Simpan</button>
        </div>
    </div>

    <!-- JavaScript for modal functionality -->
    <script>
        function openAttendanceModal(employee) {
            document.getElementById('employeeName').textContent = `Pegawai '${employee}'`;
            document.getElementById('attendanceModal').classList.remove('hidden');
        }
        
        function closeAttendanceModal() {
            document.getElementById('attendanceModal').classList.add('hidden');
        }

        function saveAttendance() {
            // Add code to handle the attendance save action here
            closeAttendanceModal();
        }

        function openEditScheduleModal(employee, time) {
            document.getElementById('editEmployeeName').textContent = `Pegawai '${employee}'`;
            const [jamMasuk, jamSelesai] = time.split(" - ");
            document.getElementById('jamMasuk').value = jamMasuk;
            document.getElementById('jamSelesai').value = jamSelesai.replace(" WIB", "");
            document.getElementById('editScheduleModal').classList.remove('hidden');
        }

        function closeEditScheduleModal() {
            document.getElementById('editScheduleModal').classList.add('hidden');
        }

        function saveSchedule() {
            // Add code to save the new schedule
            closeEditScheduleModal();
        }
    </script>
</body>
</html>

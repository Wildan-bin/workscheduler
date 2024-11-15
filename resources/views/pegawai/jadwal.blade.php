<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Pegawai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F6F2E9] font-poppins min-h-screen flex items-center justify-center">
    <!-- Container -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-md p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <!-- Update to show only the left arrow icon -->
            <a href="http://127.0.0.1:8000/pegawai/profile" class="text-gray-600 text-lg">
                ←
            </a>
            <div class="flex items-center space-x-4">
                <!-- "Halo Pegawai" Text -->
                <span class="text-gray-600 text-sm">Halo Pegawai</span>
                <!-- Profile Icon -->
                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4.418 0-8 1.79-8 4v1h16v-1c0-2.21-3.582-4-8-4z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Jadwal Pegawai</h1>

        <!-- Date Input Styled as Button -->
        <div class="relative mt-2 mb-6 text-left">
            <input type="month" id="monthInput" class="text-sm bg-[#F1C93B] text-black font-medium py-1 px-3 rounded-lg appearance-none w-auto text-left cursor-pointer focus:outline-none" onchange="updateSchedule()" />
        </div>

        <!-- Schedule List -->
        <div id="scheduleList" class="space-y-4">
            <!-- Initial schedule, will be updated via JavaScript -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Selasa, 9 Oktober 2024</h3>
                <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                    <p class="font-medium">Rahmalia Agista</p>
                    <p class="text-sm">07.00 - 13.00 WIB</p>
                </div>
            </div>
            
            <!-- Repeat for other days -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Rabu, 10 Oktober 2024</h3>
                <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                    <p class="font-medium">Rahmalia Agista</p>
                    <p class="text-sm">13.00 - 18.00 WIB</p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700">Kamis, 11 Oktober 2024</h3>
                <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                    <p class="font-medium">Rahmalia Agista</p>
                    <p class="text-sm">18.00 - 21.00 WIB</p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-700">Jumat, 12 Oktober 2024</h3>
                <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                    <p class="font-medium">Rahmalia Agista</p>
                    <p class="text-sm">12.00 - 15.00 WIB</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Array of schedules with dates for different months
        const schedules = {
            "2024-10": [
                { date: "Selasa, 9 Oktober 2024", name: "Rahmalia Agista", time: "07.00 - 13.00 WIB" },
                { date: "Rabu, 10 Oktober 2024", name: "Rahmalia Agista", time: "13.00 - 18.00 WIB" },
                { date: "Kamis, 11 Oktober 2024", name: "Rahmalia Agista", time: "18.00 - 21.00 WIB" },
                { date: "Jumat, 12 Oktober 2024", name: "Rahmalia Agista", time: "12.00 - 15.00 WIB" }
            ],
            "2024-11": [
                { date: "Selasa, 7 November 2024", name: "Budi Santoso", time: "08.00 - 14.00 WIB" },
                { date: "Rabu, 8 November 2024", name: "Budi Santoso", time: "14.00 - 20.00 WIB" },
                { date: "Kamis, 9 November 2024", name: "Budi Santoso", time: "15.00 - 18.00 WIB" },
                { date: "Jumat, 10 November 2024", name: "Budi Santoso", time: "11.00 - 16.00 WIB" }
            ]
        };

        // Function to update schedule based on selected month
        function updateSchedule() {
            const monthInput = document.getElementById("monthInput").value;
            const scheduleList = document.getElementById("scheduleList");
            scheduleList.innerHTML = ""; // Clear the current list

            if (schedules[monthInput]) {
                // Populate schedule for the selected month
                schedules[monthInput].forEach(schedule => {
                    const scheduleItem = document.createElement("div");
                    scheduleItem.innerHTML = `
                        <h3 class="text-lg font-semibold text-gray-700">${schedule.date}</h3>
                        <div class="bg-gray-400 text-white p-3 rounded-2xl mt-1">
                            <p class="font-medium">${schedule.name}</p>
                            <p class="text-sm">${schedule.time}</p>
                        </div>
                    `;
                    scheduleList.appendChild(scheduleItem);
                });
            } else {
                // Display message if no schedule is available for the selected month
                scheduleList.innerHTML = "<p class='text-center text-gray-600'>Tidak ada jadwal untuk bulan ini.</p>";
            }
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parfum Katalog</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="bg-amber-50 font-[Poppins]">
    <!-- Tombol Kembali -->
    <div class="max-w-md mx-auto p-4 bg-amber-50 flex flex-col items-center">
        <div class="w-full flex justify-start mt-2">
            <button class="text-black text-2xl">←</button>
        </div>

        <!-- Gambar dan Informasi Parfum -->
        <div class="bg-white p-3 rounded-lg shadow-md mt-4 border-2 border-[#CD9C20]">
            <img src="https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" 
                 alt="Victoria's Secret Scandal" 
                 class="w-full h-72 object-cover rounded-lg">
            <h2 class="mt-4 text-2xl font-bold text-center">Scandalous</h2>
            <p class="text-center text-lg">by Kiev Fragrance</p>
        </div>

        <!-- Pilihan Ukuran dan Harga -->
        <div class="rounded-2xl p-2 w-full mt-4 border-none">
            <div class="flex justify-center gap-4 mb-4">
                <div class="text-center bg-white p-2 rounded-lg shadow-md">
                    <p class="text-gray-500 text-sm">Size</p>
                    <p class="font-semibold text-gray-800">20 ml</p>
                    <p class="text-yellow-600 font-bold">Rp. 29.900</p>
                </div>
                <div class="text-center bg-white p-2 rounded-lg shadow-md">
                    <p class="text-gray-500 text-sm">Size</p>
                    <p class="font-semibold text-gray-800">30 ml</p>
                    <p class="text-yellow-600 font-bold">Rp. 54.900</p>
                </div>
                <div class="text-center bg-white p-2 rounded-lg shadow-md">
                    <p class="text-gray-500 text-sm">Size</p>
                    <p class="font-semibold text-gray-800">50 ml</p>
                    <p class="text-yellow-600 font-bold">Rp. 84.900</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Deskripsi Produk -->
    <div class="bg-[#EECB6D] p-8 shadow-md w-full mt-[-1rem] rounded-t-3xl relative z-0">
        <h4 class="text-2xl font-bold text-black">Description</h4>
        <p class="text-gray-800 mt-4 text-lg">
            Kiev Fragrance adalah salah satu jenis parfum inspired dari berbagai parfum ternama dunia, 
            dengan memakai bahan premium sehingga mempunyai wangi yang lebih kuat dan juga tahan lama.
        </p>
        <ul class="list-disc list-inside text-gray-800 mt-6 text-lg">
            <li>Wangi tahan lama dan tidak menyengat</li>
            <li>Baunya 95% mirip dengan aslinya</li>
            <li>Ketahanan 6 - 15 jam (tergantung pemakaian)</li>
        </ul>

        <!-- Cara Pakai -->
        <h4 class="text-2xl font-bold text-black mt-10">Cara Pakai:</h4>
        <ol class="list-decimal list-inside text-gray-800 mt-4 text-lg">
            <li>Jarak spray adalah kurang lebih 7 - 15 cm</li>
            <li>Tekan kepala spray dengan penuh (jangan setengah tekan)</li>
            <li>Tekanan yang tidak sempurna bisa menyebabkan parfum tersisa di dalam spray.</li>
        </ol>
    </div>
</body>

</html>

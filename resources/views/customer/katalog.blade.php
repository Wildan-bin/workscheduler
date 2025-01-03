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

<!-- Background separuh berwarna kuning dengan border melengkung di bagian bawah -->
<div class="absolute top-0 left-0 w-full h-1/3 bg-[#EECB6D] rounded-b-2xl"></div>

<!-- Search Bar -->
<div class="relative flex justify-center mt-6 px-4 z-10"> 
    <div class="flex items-center bg-[#EECB6D] rounded-full p-0.5 shadow-md w-full max-w-md mx-auto"> 
        <input 
            type="text" 
            placeholder="Cari" 
            class="flex-grow px-4 py-2 text-gray-800 bg-white    focus:outline-none rounded-full"
        >
    </div>
</div>

<!-- Header Banner dengan Jarak Lebih Dekat ke Elemen Bawah -->
<div class="relative max-w-4xl mx-auto p-4 pb-0 mt-2"> 
    <div class="relative rounded-lg flex flex-col items-center">
        <img src="https://i.pinimg.com/564x/6a/b1/38/6ab138742317410a16644279f5fe406e.jpg" 
             alt="Perfume" 
             class="h-40 w-full object-cover rounded-lg shadow-lg">
    </div>
</div>

<!-- Categories Tabs -->
<div class="max-w-4xl mx-auto mt-6 lg:mt-24 mb-3 flex justify-center gap-6">
    <button id="btn-men" onclick="showCategory('men')" class="category-btn w-40 px-4 py-2 rounded-full shadow-md">
        For Men
    </button>
    <button id="btn-woman" onclick="showCategory('woman')" class="category-btn w-40 px-4 py-2 rounded-full shadow-md">
        For Woman
    </button>
</div>

<!-- Product Grid -->
<div id="product-grid" class="max-w-4xl mx-auto grid grid-cols-2 gap-4 p-2"></div>

<!-- JavaScript -->
<script>
    // Data produk untuk kategori
    const products = {
        men: [
            { name: "Men's Fragrance 1", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
            { name: "Men's Fragrance 2", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
            { name: "Men's Fragrance 3", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
            { name: "Men's Fragrance 4", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
        ],
        woman: [
            { name: "Victoria's Secret Scandal", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
            { name: "Women's Fragrance 2", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
            { name: "Women's Fragrance 3", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
            { name: "Women's Fragrance 4", image: "https://i.pinimg.com/564x/b8/fa/ca/b8facaf5540f5dd200bb7ec664861c1a.jpg" },
        ]
    };

    // Fungsi untuk menampilkan produk berdasarkan kategori
    function showCategory(category) {
        const productGrid = document.getElementById('product-grid');
        productGrid.innerHTML = '';

        // Tampilkan produk sesuai kategori
        products[category].forEach(product => {
            const productCard = `
                <div class="bg-white p-3 rounded-lg shadow-md border-2 border-[#CD9C20]">
                    <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover rounded-lg">
                    <h3 class="mt-2 mb-1 text-lg font-regular text-center">${product.name}</h3>
                </div>
            `;
            productGrid.innerHTML += productCard;
        });

        // Update tombol aktif
        setActiveButton(category);
    }

    // Fungsi untuk mengatur tombol aktif
    function setActiveButton(category) {
        const menButton = document.getElementById('btn-men');
        const womanButton = document.getElementById('btn-woman');

        if (category === 'men') {
            menButton.classList.add('bg-[#CD9C20]', 'text-white');
            menButton.classList.remove('bg-white', 'text-black');
            womanButton.classList.remove('bg-[#CD9C20]', 'text-white');
            womanButton.classList.add('bg-white', 'text-black');
        } else {
            womanButton.classList.add('bg-[#CD9C20]', 'text-white');
            womanButton.classList.remove('bg-white', 'text-black');
            menButton.classList.remove('bg-[#CD9C20]', 'text-white');
            menButton.classList.add('bg-white', 'text-black');
        }
    }

    // Tampilkan produk wanita secara default
    showCategory('woman');
</script>

<style>
    .category-btn {
        transition: background-color 0.3s ease, color 0.3s ease;
    }
</style>

</body>
</html>

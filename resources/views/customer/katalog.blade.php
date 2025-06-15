<x-layout>
    <!-- Background separuh berwarna kuning dengan border melengkung di bagian bawah -->
    <div class="absolute top-0 left-0 w-full h-1/3 bg-[#EECB6D] rounded-b-2xl">
    </div>

    <!-- Search Bar -->
    <div class="relative flex justify-center mt-6 px-4 z-10">
        <form method="GET" action="/katalog" class="mb-6 w-96">
            <div class="flex items-center bg-[#EECB6D] rounded-full p-0.5 shadow-md w-full max-w-md mx-auto">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari produk..."
                    value="{{ request('search') }}"
                    class="flex-grow px-4 py-2 text-gray-800 bg-white focus:outline-none rounded-full">
                <button
                    type="submit"
                    class="bg-[#CD9C20] text-white ms-2 px-4 py-2 rounded-3xl hover:bg-blue-600">
                    Cari
                </button>
            </div>
        </form>
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
        <button id="btn-all" 
                onclick="showAllProducts()" 
                class="category-btn w-40 px-4 py-2 rounded-full shadow-md bg-[#CD9C20] text-white">
            All
        </button>
        @foreach($kategoris as $kategori)
            <button id="btn-{{ Str::slug($kategori->name) }}" 
                    onclick="showCategory('{{ $kategori->id }}')" 
                    class="category-btn w-40 px-4 py-2 rounded-full shadow-md bg-white text-black">
                {{ $kategori->name }}
            </button>
        @endforeach
    </div>

    <!-- Product Grid -->
    <div id="product-grid" class="max-w-4xl mx-auto grid grid-cols-2 gap-4 p-2"></div>

    <br>
    <!-- Replace the existing product card with this new version -->
    <div id="" class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
        @foreach($produks as $product)
        <div class="product-card" data-categories="{{ implode(',', $product->kategoris->pluck('id')->toArray()) }}">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Product Image -->
                <div class="relative">
                    <img src="{{ asset('images/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <h3 class="text-white text-xl font-semibold">{{ $product->name }}</h3>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="p-4">
                    <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
                    
                    <!-- Variations Accordion -->
                    <div class="space-y-2">
                        <button 
                            onclick="toggleVariations('{{ $product->id }}')"
                            class="flex items-center justify-between w-full px-4 py-2 bg-[#EECB6D] text-white rounded-lg hover:bg-[#CD9C20] transition-colors duration-200"
                        >
                            <span>Lihat Variasi</span>
                            <svg id="arrow-{{ $product->id }}" class="w-5 h-5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div id="variations-{{ $product->id }}" class="hidden">
                            <div class="grid grid-cols-1 gap-2 mt-2">
                                @foreach($product->variasis as $variasi)
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-sm font-medium">{{ $variasi->size }} ml</span>
                                            <p class="text-[#CD9C20] font-semibold">Rp {{ number_format($variasi->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm text-gray-500">Stok: {{ $variasi->stock }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- JavaScript -->
    <script>
function showCategory(categoryId) {
    // Update active button styling
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-[#CD9C20]', 'text-white');
        btn.classList.add('bg-white', 'text-black');
    });
    
    const activeBtn = document.querySelector(`button[onclick="showCategory('${categoryId}')"]`);
    if (activeBtn) {
        activeBtn.classList.remove('bg-white', 'text-black');
        activeBtn.classList.add('bg-[#CD9C20]', 'text-white');
    }

    // Show/hide products based on category
    document.querySelectorAll('.product-card').forEach(card => {
        const categoryIds = card.dataset.categories.split(',').map(id => id.trim());
        if (categoryIds.includes(categoryId)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function showAllProducts() {
    // Update active button styling
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('bg-[#CD9C20]', 'text-white');
        btn.classList.add('bg-white', 'text-black');
    });
    
    // Set All button active
    document.getElementById('btn-all').classList.remove('bg-white', 'text-black');
    document.getElementById('btn-all').classList.add('bg-[#CD9C20]', 'text-white');

    // Show all products
    document.querySelectorAll('.product-card').forEach(card => {
        card.style.display = 'block';
    });
}

// Update DOMContentLoaded to show all products by default
document.addEventListener('DOMContentLoaded', function() {
    showAllProducts();
});

function toggleVariations(productId) {
    const variationsDiv = document.getElementById(`variations-${productId}`);
    const arrow = document.getElementById(`arrow-${productId}`);
    
    if (variationsDiv.classList.contains('hidden')) {
        // Show variations with smooth animation
        variationsDiv.classList.remove('hidden');
        variationsDiv.style.maxHeight = '0';
        setTimeout(() => {
            variationsDiv.style.maxHeight = variationsDiv.scrollHeight + 'px';
        }, 10);
        arrow.style.transform = 'rotate(180deg)';
    } else {
        // Hide variations with smooth animation
        variationsDiv.style.maxHeight = '0';
        setTimeout(() => {
            variationsDiv.classList.add('hidden');
        }, 200);
        arrow.style.transform = 'rotate(0)';
    }
}
</script>

    <style>
        .category-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
</x-layout>
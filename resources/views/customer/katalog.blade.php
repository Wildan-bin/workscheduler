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
                    class="flex-grow px-4 py-2 text-gray-800 text-xs lg:text-base bg-white focus:outline-none rounded-full">
                <button
                    type="submit"
                    class="bg-[#CD9C20] text-white ms-2 text-xs lg:text-base px-4 py-2 rounded-3xl hover:bg-blue-600">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Header Banner dengan Jarak Lebih Dekat ke Elemen Bawah -->
    <div class="relative max-w-4xl mx-auto p-5 pb-0 mt-2">
        <div class="relative rounded-lg flex flex-col items-center">
            <img src="{{ asset('images/kiev.png') }}"
                alt="Perfume"
                class="h-40 w-11/12 object-cover rounded-md shadow-lg">
        </div>
    </div>

    <!-- Categories Tabs -->
    <!-- <div class="flex md:justify-center gap-2 md:gap-4 overflow-x-auto px-8 lg:px-0 py-2">
        <button id="btn-all"
            onclick="showAllProducts()"
            class="category-btn w-30 lg:w-40 text-xs lg:text-base px-4 py-2 rounded-full shadow-md bg-[#CD9C20] text-white">
            All
        </button>
        @foreach($kategoris as $kategori)
        <button id="btn-{{ Str::slug($kategori->name) }}"
            onclick="showCategory('{{ $kategori->id }}')"
            class="category-btn w-30 lg:w-40 text-xs lg:text-base px-4 py-2 rounded-full shadow-md bg-white text-black">
            {{ $kategori->name }}
        </button>
        @endforeach
    </div> -->

    <div class="flex md:justify-center gap-2 md:gap-4 overflow-x-auto px-8 lg:px-0 py-2">
            <div class="flex flex-col items-center">
                <button id="btn-all" 
                        onclick="showAllProducts()" 
                        class="category-btn min-w-[130px] md:min-w-[160px] text-xs lg:text-base px-4 py-2 rounded-full shadow-md bg-[#CD9C20] text-white">
                    All
                </button>
            </div>
            
            @foreach($kategoris as $kategori)
            <div class="flex flex-col items-center gap-2">
                
                <!-- Category Button -->
                <button id="btn-{{ Str::slug($kategori->name) }}" 
                        onclick="showCategory('{{ $kategori->id }}')" 
                        class="category-btn min-w-[130px] md:min-w-[160px] text-xs lg:text-base px-4 py-2 rounded-full shadow-md bg-white text-black">
                    {{ $kategori->name }}
                </button>
            </div>
            @endforeach
        </div>

    <!-- Product Grid -->
    <div id="product-grid" class="max-w-4xl mx-auto grid grid-cols-2 gap-4 p-2"></div>

    <br>
    <!-- Replace the existing product card with this new version -->
    <div id="" class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:p-4 px-6 md:px-10">
        @foreach($produks as $product)
        <div class="product-card" data-categories="{{ implode(',', $product->kategoris->pluck('id')->toArray()) }}">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Product Image -->
                <div class="relative">
                    <img src="{{ asset('images/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full h-32 md:h-48 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                        <h3 class="text-white text-xl font-semibold">{{ $product->name }}</h3>
                    </div>
                </div>

                <!-- Product Description -->
                <div class="p-4">
                    <div class="text-gray-600 text-xs md:text-sm mb-4">
                        <div id="description-short-{{ $product->id }}" class="md:hidden">
                            @php
                                $words = explode(' ', strip_tags($product->description));
                                $shortDescription = implode(' ', array_slice($words, 0, 15));
                                $hasMore = count($words) > 15;
                            @endphp
                            {{ $shortDescription }}{{ $hasMore ? '...' : '' }}
                            @if($hasMore)
                                <button onclick="toggleDescription('{{ $product->id }}')" class="text-[#CD9C20] font-semibold hover:underline ml-1">Baca selengkapnya
                                </button>
                            @endif
                        </div>
                        <div id="description-full-{{ $product->id }}" class="hidden md:block">
                            {!! nl2br(e($product->description)) !!}
                            @if($hasMore)
                                <button onclick="toggleDescription('{{ $product->id }}')" class="text-[#CD9C20] font-semibold hover:underline ml-1 md:hidden">
                                    Sembunyikan
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Variations Accordion -->
                    <div class="space-y-2">
                        <button
                            onclick="toggleVariations('{{ $product->id }}')"
                            class="flex items-center justify-between w-full px-4 py-2 bg-[#EECB6D] text-white text-xs lg:text-base rounded-lg hover:bg-[#CD9C20] transition-colors duration-200">
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

    <div class="link flex justify-center my-12">
        <a href="https://shopee.co.id/kievparfume?categoryId=100630&entryPoint=ShopByPDP&itemId=22477701688" class="text-[#CD9C20] font-semibold hover:underline text-lg flex items-center space-x-2" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" fill="#CD9C20" viewBox="0 0 24 24" stroke-width="0" stroke="none" class="size-8">
                <path d="M21.82 7.01a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v.75h-1.5v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v.75h-1.5v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v.75h-1.5v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75v.75H2.93a.75.75 0 0 0-.75.75v9.5a.75.75 0 0 0 .75.75h18.94a.75.75 0 0 0 .75-.75v-9.5a.75.75 0 0 0-.75-.75Zm-1.5 8.25h-15v-7h15v7Zm-3-3.5a.75.75 0 0 1-.75.75h-6a.75.75 0 0 1 0-1.5h6a.75.75 0 0 1 .75.75Zm-3-2a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1 0-1.5h3a.75.75 0 0 1 .75.75Z" />
            </svg>
            <span>Belanja di Shopee</span>
        </a>
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

        function toggleDescription(productId) {
            const shortDescription = document.getElementById(`description-short-${productId}`);
            const fullDescription = document.getElementById(`description-full-${productId}`);

            if (shortDescription.classList.contains('hidden')) {
                shortDescription.classList.remove('hidden');
                fullDescription.classList.add('hidden');
            } else {
                shortDescription.classList.add('hidden');
                fullDescription.classList.remove('hidden');
            }
        }
    </script>

    <style>
        .category-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
</x-layout>
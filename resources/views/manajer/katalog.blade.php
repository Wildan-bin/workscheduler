<x-layout>

    @if (session('success'))
    <script>
        alert('{{ session("success") }}');
    </script>
    @endif

    @if (session('error'))
    <script>
        alert('{{ session("error") }}');
    </script>
    @endif

    <div class="flex flex-row">
        <form action="{{ route('dashboard') }}" method="GET" class="absolute top-8 left-10">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </button>
        </form>
        <h1 class="absolute top-8 right-10 font-semibold text-normal">Halo, Wildan</h1>
    </div>
    <section class="mt-2 md:mt-12 md:mx-4 lg:mx-20">
        <div class="px-6 py-16 lg:py-6 mx-auto">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0 relative">
                <h1
                    class="text-4xl font-bold leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Katalog Produk
                </h1>
                <!-- tambahkan route ke katalog produk bagian customer -->
                <a type="submit " href="{{ route('katalog') }}" target="blank"
                    class="w-2/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-xl text-xs px-1 py-1.5 text-center absolute">
                    Lihat Katalog
                </a>
            </div>
        </div>
    </section>
    <!-- TAMBAH PRODUK -->

    <section class="container mx-auto lg:mt-32 px-4 md:px-10 lg:px-20">
        <h1 class="text-2xl font-bold mb-6">Manajemen Produk</h1>

        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <!-- Button Tambah Produk -->
            <button
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                onclick="openModal('createModal')">
                Tambah Produk
            </button>
            
            <!-- Button Tambah Kategori -->
            <button
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                onclick="openModal('createCategoryModal')">
                Tambah Kategori
            </button>
        </div>
        <!-- Categories Tabs -->
        <div class="flex md:justify-center gap-2 md:gap-4 overflow-x-auto px-8 lg:px-0 py-2">
            <div class="flex flex-col items-center">
                <button id="btn-all" 
                        onclick="showAllProducts()" 
                        class="category-btn min-w-[160px] px-4 py-2 rounded-full shadow-md bg-[#CD9C20] text-white">
                    All
                </button>
            </div>
            
            @foreach($kategoris as $kategori)
            <div class="flex flex-col items-center gap-2">
                
                <!-- Category Button -->
                <button id="btn-{{ Str::slug($kategori->name) }}" 
                        onclick="showCategory('{{ $kategori->id }}')" 
                        class="category-btn min-w-[160px] px-4 py-2 rounded-full shadow-md bg-white text-black">
                    {{ $kategori->name }}
                </button>
                <!-- Edit & Delete Icons -->
                <div class="flex gap-2 mb-1 hidden" id="editDeleteKategori">
                    <button onclick="editKategori({{ $kategori->id }})" 
                            class="p-1 rounded-full bg-yellow-500 hover:bg-yellow-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <button onclick="deleteKategori({{ $kategori->id }})" 
                            class="p-1 rounded-full bg-red-500 hover:bg-red-600 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Category Description -->
        <div id="categoryDescription" class="hidden max-w-4xl mx-auto mb-6 text-center">
            <p class="text-gray-700 text-normal lg:text-md font-medium"></p>
        </div>

        <div class="container mx-auto">
            @foreach($products as $product)
            <div class="product-card p-3" data-categories="{{ implode(',', $product->kategoris->pluck('id')->toArray()) }}">
                <!-- Card Produk Utama -->
                <div class="bg-[#EECB6D] rounded-3xl shadow-lg p-4 lg:p-6 mb-4">
                    <div class="flex flex-col sm:flex-row items-center mb-4">
                        <div class="relative mb-4">
                            @if ($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg">
                            <!-- Button Edit Produk -->
                            <button
                                class="absolute top-0 left-36 bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600"
                                onclick="openModal('editProductModal', {{ json_encode($product) }})">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <!-- Button Tambah Variasi -->
                            <button
                                class="absolute top-10 left-36 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600"
                                onclick="openModal('addVariasiModal', {{ json_encode(['produk_id' => $product->id]) }})">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <!-- Button Hapus Produk -->
                            <button
                                class="absolute top-20 left-36 bg-red-500 text-white p-2 rounded-full hover:bg-red-600"
                                onclick="openModal('deleteProductModal', {{ json_encode($product) }})">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                            @endif
                        </div>
                        <div class="md:w-10/12 md:ml-20">
                            <div class="flex justify-between items-start">
                                <h3 class="text-base md:text-lg font-semibold lg:text-2xl mb-2">{{$product->name}}</h3>
                                <!-- Category Dropdown -->
                                <div class="flex items-center gap-2">
                                    <select id="category_select_{{$product->id}}" 
                                            class="border rounded-lg px-3 py-1 text-xs md:text-sm"
                                            onchange="showSaveButton({{$product->id}})">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{$kategori->id}}"
                                                {{ $product->kategoris->contains('id', $kategori->id) ? 'selected' : '' }}>
                                                {{$kategori->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button id="save_category_{{$product->id}}" 
                                            onclick="saveProductCategory({{$product->id}})"
                                            class="bg-green-500 text-white px-3 py-1 rounded-lg text-sm hidden hover:bg-green-600">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                            <p class="text-gray-600 text-xs md:text-sm lg:text-md">{!! nl2br(e($product->description)) !!}</p>
                        </div>
                    </div>

                    <!-- Variasi Produk -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($product->variasis as $variasi)
                        <div class="bg-white rounded-lg p-4 shadow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold mb-2">Variasi {{$loop->iteration}}</h3>
                                    <p class="text-xs md:text-sm lg:text-md">Size: {{$variasi->size}} ml</p>
                                    <p class="text-xs md:text-sm lg:text-md">Rp{{ number_format($variasi->price, 0, ',', '.') }}</p>
                                    <p class="text-xs md:text-sm lg:text-md">Stok: {{ $variasi->stock ?? 'Kosong' }}</p>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs md:text-sm"
                                        onclick="openModal('editModal', {{ json_encode($variasi) }})">
                                        Edit
                                    </button>
                                    <button
                                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 text-xs md:text-sm"
                                        onclick="openModal('deleteVariasiModal', {{ json_encode($variasi) }})">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Modal Tambah Produk -->
        <div id="createModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>
                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-bold mb-2">Nama Produk</label>
                        <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-bold mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="w-full border px-3 py-2 rounded" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-bold mb-2">Gambar Produk</label>
                        <input type="file" name="image" id="image" class="w-full border px-3 py-2 rounded" accept="image/*">
                        <img id="create_preview_image" src="" alt="" class="mt-2 w-32 h-32 object-cover rounded hidden">
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('createModal')">Batal</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


    </section>

    <!-- Modal Edit Produk -->
    <div id="editModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-2/12">
            <h2 class="text-xl font-bold mb-4">Edit Variasi Produk</h2>
            <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_size" class="block text-sm font-bold">Ukuran (ml)</label>
                    <input type="number" name="size" id="edit_size" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit_price" class="block text-sm font-bold">Harga</label>
                    <input type="number" name="price" id="edit_price" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit_stock" class="block text-sm font-bold">Stok</label>
                    <input type="number" name="stock" id="edit_stock" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    
    <!-- Modal Edit Produk -->
    <div id="editProductModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Produk</h2>
            <form id="editProductForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="edit_product_name" class="block text-sm font-bold mb-2">Nama Produk</label>
                    <input type="text" name="name" id="edit_product_name" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="edit_product_description" class="block text-sm font-bold mb-2">Deskripsi</label>
                    <textarea name="description" id="edit_product_description" rows="3" class="w-full border px-3 py-2 rounded" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="edit_product_image" class="block text-sm font-bold mb-2">Gambar Produk</label>
                    <input type="file" name="image" id="edit_product_image" class="w-full border px-3 py-2 rounded" accept="image/*">
                    <img id="preview_image" src="" alt="" class="mt-2 w-32 h-32 object-cover rounded hidden">
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('editProductModal')">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    <div id="editCategoryModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>
            <form method="POST" action="" id="editCategoryForm">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_category_id" name="id">
                
                <div class="mb-4">
                    <label for="edit_category_name" class="block text-sm font-bold mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="edit_category_name" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="edit_category_description" class="block text-sm font-bold mb-2">Deskripsi</label>
                    <textarea name="description" id="edit_category_description" rows="3" class="w-full border px-3 py-2 rounded" required></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('editCategoryModal')">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Variasi -->
    <div id="addVariasiModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Tambah Variasi Produk</h2>
            <form id="addVariasiForm" method="POST" action="{{ route('variasi.store') }}">
                @csrf
                <input type="hidden" name="produk_id" id="variasi_produk_id">
                
                <div class="mb-4">
                    <label for="size" class="block text-sm font-bold mb-2">Ukuran (ml)</label>
                    <input type="number" name="size" id="size" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block text-sm font-bold mb-2">Harga</label>
                    <input type="number" name="price" id="price" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="stock" class="block text-sm font-bold mb-2">Stok</label>
                    <input type="number" name="stock" id="stock" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('addVariasiModal')">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Produk -->

    <div id="deleteProductModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full lg:w-1/5">
            <h2 class="text-xl font-bold mb-4 text-center">Hapus Produk</h2>
            <p class="text-center">Apakah Anda yakin ingin menghapus produk ini?</p>
            <form id="deleteProductForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-center space-x-4 mt-6">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('deleteProductModal')">Batal</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Variasi -->
    <div id="deleteVariasiModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full lg:w-1/5">
            <h2 class="text-xl font-bold mb-4 text-center">Hapus Variasi</h2>
            <p class="text-center">Apakah Anda yakin ingin menghapus variasi ini?</p>
            <form id="deleteVariasiForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-center space-x-4 mt-6">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('deleteVariasiModal')">Batal</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div id="createCategoryModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>
            <form method="POST" action="{{ route('kategori.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="category_name" class="block text-sm font-bold mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="category_name" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="category_description" class="block text-sm font-bold mb-2">Deskripsi</label>
                    <textarea name="description" id="category_description" rows="3" class="w-full border px-3 py-2 rounded" required></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('createCategoryModal')">Batal</button>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function openModal(modalId, data = null) {
            document.getElementById(modalId).classList.remove('hidden');
            
            if (modalId === 'editModal' && data) {
                // Existing variasi edit code
                document.getElementById('edit_size').value = data.size;
                document.getElementById('edit_price').value = data.price;
                document.getElementById('edit_stock').value = data.stock;
                document.getElementById('editForm').action = `/admin/variasi/${data.id}`;
            }
            
            if (modalId === 'editProductModal' && data) {
                // Fill product edit form
                document.getElementById('edit_product_name').value = data.name;
                document.getElementById('edit_product_description').value = data.description;
                document.getElementById('editProductForm').action = `/admin/katalog/${data.id}`;
                
                // Show image preview if exists
                const previewImage = document.getElementById('preview_image');
                if (data.image) {
                    previewImage.src = `/images/${data.image}`;
                    previewImage.classList.remove('hidden');
                } else {
                    previewImage.classList.add('hidden');
                }
            }
            
            if (modalId === 'addVariasiModal' && data) {
                // Set produk_id for variasi
                document.getElementById('variasi_produk_id').value = data.produk_id;
            }

            if (modalId === 'deleteProductModal' && data) {
                document.getElementById('deleteProductForm').action = `/admin/katalog/${data.id}`;
            }

            if (modalId === 'deleteVariasiModal' && data) {
                document.getElementById('deleteVariasiForm').action = `/admin/variasi/${data.id}`;
            }

            if (modalId === 'createCategoryModal') {
                // Reset form jika diperlukan
                document.getElementById('category_name').value = '';
                document.getElementById('category_description').value = '';
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Image preview handler
        document.getElementById('edit_product_image').addEventListener('change', function(event) {
            const previewImage = document.getElementById('preview_image');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Image preview handler untuk create modal
        document.getElementById('image').addEventListener('change', function(event) {
            const previewImage = document.getElementById('create_preview_image');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        function showCategory(categoryId) {
            // Update active button styling
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('bg-[#CD9C20]', 'text-white');
                btn.classList.add('bg-white', 'text-black');
                
                // Hide all edit/delete buttons
                const parentDiv = btn.closest('.flex.flex-col');
                if (parentDiv) {
                    const editDeleteDiv = parentDiv.querySelector('#editDeleteKategori');
                    if (editDeleteDiv) {
                        editDeleteDiv.classList.add('hidden');
                    }
                }
            });
            
            // Hide description
            const descriptionDiv = document.getElementById('categoryDescription');
            descriptionDiv.classList.add('hidden');
            
            const activeBtn = document.querySelector(`button[onclick="showCategory('${categoryId}')"]`);
            if (activeBtn) {
                activeBtn.classList.remove('bg-white', 'text-black');
                activeBtn.classList.add('bg-[#CD9C20]', 'text-white');
                
                // Show edit/delete buttons for active category
                const parentDiv = activeBtn.closest('.flex.flex-col');
                if (parentDiv) {
                    const editDeleteDiv = parentDiv.querySelector('#editDeleteKategori');
                    if (editDeleteDiv) {
                        editDeleteDiv.classList.remove('hidden');
                    }
                }
                
                // Show description for active category
                fetch(`/admin/kategori/${categoryId}/edit`)
                    .then(response => response.json())
                    .then(kategori => {
                        descriptionDiv.querySelector('p').textContent = kategori.description;
                        descriptionDiv.classList.remove('hidden');
                    });
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
                
                // Hide all edit/delete buttons
                const parentDiv = btn.closest('.flex.flex-col');
                if (parentDiv) {
                    const editDeleteDiv = parentDiv.querySelector('#editDeleteKategori');
                    if (editDeleteDiv) {
                        editDeleteDiv.classList.add('hidden');
                    }
                }
            });
            
            // Hide description
            document.getElementById('categoryDescription').classList.add('hidden');
            
            // Set All button active
            document.getElementById('btn-all').classList.remove('bg-white', 'text-black');
            document.getElementById('btn-all').classList.add('bg-[#CD9C20]', 'text-white');

            // Show all products
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.display = 'block';
            });
        }

        // Show all products by default
        document.addEventListener('DOMContentLoaded', function() {
            showAllProducts();
        });

        function editKategori(id) {
    // Mengambil data kategori
    fetch(`/admin/kategori/${id}/edit`)
        .then(response => response.json())
        .then(kategori => {
            // Set form action
            document.getElementById('editCategoryForm').action = `/admin/kategori/${id}`;
            // Buka modal edit dan isi data
            document.getElementById('edit_category_id').value = kategori.id;
            document.getElementById('edit_category_name').value = kategori.name;
            document.getElementById('edit_category_description').value = kategori.description;
            openModal('editCategoryModal');
        });
}

function deleteKategori(id) {
    if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
        // Submit form delete
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/kategori/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Store initial category values when page loads
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[id^="category_select_"]').forEach(select => {
        select.setAttribute('data-original', select.value);
    });
});

function showSaveButton(productId) {
    const select = document.getElementById(`category_select_${productId}`);
    const saveButton = document.getElementById(`save_category_${productId}`);
    const originalValue = select.getAttribute('data-original');
    
    // Only show save button if selected value is different from original
    if (select.value !== originalValue) {
        saveButton.classList.remove('hidden');
    } else {
        saveButton.classList.add('hidden');
    }
}

function saveProductCategory(productId) {
    const select = document.getElementById(`category_select_${productId}`);
    const saveButton = document.getElementById(`save_category_${productId}`);
    const categoryId = select.value;
    
    if (!categoryId) {
        alert('Silakan pilih kategori terlebih dahulu');
        return;
    }

    // Create form data
    const formData = new FormData();
    formData.append('produk_id', productId);
    formData.append('kategori_id', categoryId);
    formData.append('_token', '{{ csrf_token() }}');

    // Send request to server
    fetch('/admin/produk-kategori', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the original value after successful save
            select.setAttribute('data-original', categoryId);
            // Hide save button
            saveButton.classList.add('hidden');
            alert('Kategori berhasil ditambahkan');
            // Refresh page
            window.location.reload();
        } else {
            alert('Gagal menambahkan kategori');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menyimpan kategori');
    });
}

// Example for delete product:
function deleteProduct(productId) {
    if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
        const deleteButton = document.querySelector(`button[onclick="deleteProduct(${productId})"]`);
        
        showLoadingAndRefresh(deleteButton, () =>
            fetch(`/admin/produk/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
        );
    }
}

// Example for edit variation:
function saveVariation(variationId) {
    const form = document.getElementById(`edit-variation-${variationId}`);
    const saveButton = form.querySelector('button[type="submit"]');
    const formData = new FormData(form);

    showLoadingAndRefresh(saveButton, () =>
        fetch(`/admin/variasi/${variationId}`, {
            method: 'POST',
            body: formData
        })
    );
}
    </script>

    <style>
        .category-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    </style>
</x-layout>


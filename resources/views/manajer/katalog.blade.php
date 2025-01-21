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
        <form action="{{ route('dashboard') }}" method="GET" class="absolute top-5 left-5">
            @csrf
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </button>
        </form>
        <h1 class="absolute top-5 right-5 font-semibold text-sm">Halo, Wildan</h1>
    </div>
    <section class="">
        <div class="px-6 py-6 mx-auto lg:py-0">
            <div class="w-full bg-transparent rounded-lg md:mt-0 sm:max-w-md xl:p-0 relative">
                <h1
                    class="text-4xl font-bold tracking-normal leading-tight tracking-tight text-zinc-800 mb-5 self-start">
                    Katalog Produk
                </h1>
                <!-- tambahkan route ke katalog produk bagian customer -->
                <a type="submit " href=""
                    class="w-2/5 text-amber-400 bg-zinc-700 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-xl text-xs px-1 py-1.5 text-center absolute">
                    Lihat Katalog
                </a>
            </div>
        </div>
    </section>

    <!-- TAMBAH PRODUK -->

    <section class="container mx-auto px-4 lg:mt-32">
        <h1 class="text-2xl font-bold mb-6">Manajemen Produk</h1>

        <!-- Button Tambah Produk -->
        <button
            class="bg-blue-500 text-white px-4 py-2 rounded mb-4 hover:bg-blue-600"
            onclick="openModal('createModal')">
            Tambah Produk
        </button>
        <div class="container mx-auto">
            @foreach($products as $product)
            <div class="p-3">
                <div class="w-2/5 bg-[#EECB6D] rounded-3xl shadow-lg p-4 lg:p-6 lg:px-12 flex items-center">
                    @if ($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover">
                    @else
                    <span class="text-gray-500">Tidak ada gambar</span>
                    @endif
                    <div class="w-auto ml-2 ">
                        <h3 class="text-lg font-semibold lg:text-2xl">{{$product->name}}</h3>
                        <h3 class="text-sm lg:text-lg">{{$product->size}} ml</h3>
                        <h3 class="text-sm lg:text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</h3>
                        <br>
                        <h3 class="text-sm lg:text-md">stok {{ $product->stock ?? 'Kosong' }}</h3>
                        <p class="text-gray-600 text-xs md:text-sm lg:text-md">{{ $product->description }}</p>
                    </div>
                    <button
                        class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600"
                        onclick="openModal('editModal', {{ json_encode($product) }})">
                        Edit
                    </button>
                    <button
                        class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                        onclick="openModal('deleteModal', {{ json_encode($product) }})">
                        Hapus
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Modal Tambah Produk -->
        <div id="createModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-full">
                <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>
                <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-bold">Nama Produk</label>
                        <input type="text" name="name" id="name" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="size" class="block text-sm font-bold">Ukuran (ml)</label>
                        <input type="number" name="size" id="size" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-bold">Harga</label>
                        <input type="number" name="price" id="price" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-bold">Deskripsi</label>
                        <textarea name="description" id="description" class="w-full border px-3 py-2 rounded" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-bold">Stok (opsional)</label>
                        <input type="number" name="stock" id="stock" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-bold mb-2">Gambar Produk:</label>
                        <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
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
        <div class="bg-white p-6 rounded shadow-lg w-full">
            <h2 class="text-xl font-bold mb-4">Edit Produk</h2>
            <form id="editForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if ($product->image)
                <img id="edit_image" alt="{{ $product->name }}" class="w-36 h-36 object-cover">
                @else
                <span class="text-gray-500">Tidak ada gambar</span>
                @endif
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-bold">Nama Produk</label>
                    <input type="text" name="name" id="edit_name" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit_size" class="block text-sm font-bold">Ukuran (ml)</label>
                    <input type="number" name="size" id="edit_size" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit_price" class="block text-sm font-bold">Harga</label>
                    <input type="number" name="price" id="edit_price" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="edit_description" class="block text-sm font-bold">Deskripsi</label>
                    <textarea name="description" id="edit_description" class="w-full border px-3 py-2 rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="edit_stock" class="block text-sm font-bold">Stok</label>
                    <input type="number" name="stock" id="edit_stock" class="w-full border px-3 py-2 rounded">
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Gambar Produk</label>
                    <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('editModal')">Batal</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Produk -->

    <div id="deleteModal" class="modal hidden fixed px-3 inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full lg:w-1/5">
            <h2 class="text-xl font-bold mb-4 text-center">Hapus Produk</h2>
            <p class="text-center">Apakah Anda yakin ingin menghapus produk ini?</p>
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex justify-center space-x-4 mt-6">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal('deleteModal')">Batal</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Hapus</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function openModal(modalId, product = null) {
            console.log('product id = ' + product);
            console.log('product image = ' + product.image);
            document.getElementById(modalId).classList.remove('hidden');
            if (modalId === 'editModal' && product) {
                document.getElementById('edit_name').value = product.name;
                document.getElementById('edit_size').value = product.size.replace(' ml', '');
                document.getElementById('edit_price').value = product.price;
                document.getElementById('edit_description').value = product.description;
                document.getElementById('edit_stock').value = product.stock;
                document.getElementById('edit_image').src = `{{ asset('images/${product.image}') }}`;
                document.getElementById('editForm').action = `/admin/katalog/${product.id}`;


                // Menampilkan gambar produk jika tersedia
                const imageElement = document.getElementById('productImage');
                const noImageText = document.getElementById('noImageText');

                if (product.image) {
                    imageElement.src = `/images/${product.image}`;
                    imageElement.alt = product.name || 'Product Image';
                    imageElement.classList.remove('hidden');
                    noImageText.classList.add('hidden');
                } else {
                    imageElement.classList.add('hidden');
                    noImageText.classList.remove('hidden');
                }
            }
            if (modalId === 'deleteModal' && product) {
                document.getElementById('deleteForm').action = `/admin/katalog/${product.id}`;
            }
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>

</x-layout>
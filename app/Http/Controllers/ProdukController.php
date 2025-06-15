<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index(Request $request) {
        $products = Produk::with(['variasis', 'kategoris'])->get();
        $kategoris = \App\Models\Kategori::all();
        return view('manajer.katalog', compact('products', 'kategoris'));
    }

    public function indexKatalog(Request $request)
    {
        // Cek apakah ada filter pencarian
        $produks = request('search') 
            ? Produk::with(['variasis', 'kategoris'])->filter(request(['search']))->latest()->paginate(9)->withQueryString()
            : Produk::with(['variasis', 'kategoris'])->latest()->paginate(9);

        $kategoris = \App\Models\Kategori::all();

        return view('customer.katalog', [
            'title' => 'Daftar Produk',
            'produks' => $produks,
            'kategoris' => $kategoris
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        try {
            $data = $request->only(['name', 'description', 'image']);
    
            // Upload gambar jika ada
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->extension();
                $request->image->move(public_path('images'), $fileName);
                $data['image'] = $fileName; // Simpan nama file ke database
            }
    
            // Simpan data ke database
            Produk::create($data);
    
            return redirect()->route('catalog')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }


    public function edit($id)
    {
        $product = Produk::find($id); // Mengambil data produk berdasarkan ID
        return view('manajer.katalog', compact('product')); // Kirim data produk ke view
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validasi gambar
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($produk->image && file_exists(public_path('images/' . $produk->image))) {
                unlink(public_path('images/' . $produk->image));
            }

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $data['image'] = $fileName;
        }

        $produk->update($data);
        return redirect()->route('catalog')->with('success', 'Produk berhasil diperbarui');
    }


    public function destroy($id)
    {
        try {
            $product = Produk::findOrFail($id);
            
            // Hapus gambar jika ada
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
            
            // Hapus semua variasi terkait
            $product->variasis()->delete();
            
            // Hapus produk
            $product->delete();

            // Reset auto-increment ID
            DB::statement('ALTER TABLE produks AUTO_INCREMENT = 1');
            
            // Reorder existing IDs
            $products = Produk::orderBy('id')->get();
            foreach($products as $index => $product) {
                $product->update(['id' => $index + 1]);
            }

            return redirect()->back()->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
    
    public function addCategory(Request $request)
    {
        try {
            // Check if relationship already exists
            $exists = DB::table('produk_kategoris')
                ->where('produk_id', $request->produk_id)
                ->exists();

            if ($exists) {
                // Update existing relationship
                DB::table('produk_kategoris')
                    ->where('produk_id', $request->produk_id)
                    ->update([
                        'kategori_id' => $request->kategori_id,
                        'updated_at' => now()
                    ]);
            } else {
                // Create new relationship
                DB::table('produk_kategoris')->insert([
                    'produk_id' => $request->produk_id,
                    'kategori_id' => $request->kategori_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Kategori berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui kategori'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    public function index(Request $request)
    {

        $products = Produk::all();

        return view('manajer.katalog', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'nullable|numeric',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        try {
            $data = $request->only(['name', 'size', 'price', 'description', 'stock', 'image']);
    
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
            'size' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'nullable|numeric',
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
        $product = Produk::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }
}

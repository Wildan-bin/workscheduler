<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukVariasi;

class VariasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'size' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);

        try {
            ProdukVariasi::create($request->all());
            return redirect()->back()->with('success', 'Variasi produk berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan variasi'])->withInput();
        }
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'size' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'nullable|numeric',
        ]);

        $variasi = ProdukVariasi::findOrFail($id);
        $variasi->update($request->only(['size', 'price', 'stock']));

        return redirect()->back()->with('success', 'Variasi produk berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        try {
            $variasi = ProdukVariasi::findOrFail($id);
            $variasi->delete();
            
            return redirect()->back()->with('success', 'Variasi berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus variasi');
        }
    }
}

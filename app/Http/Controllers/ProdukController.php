<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function indexKatalog(Request $request)
    {

        $products = Produk::all();

        return view('customer.katalog', compact('products'));
    }
}

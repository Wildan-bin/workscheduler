<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVariasi extends Model
{
    use HasFactory;

    protected $table = 'produk_variasis';

    protected $fillable = [
        'produk_id',
        'size',
        'price',
        'stock'
        // Add other fields as needed
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}

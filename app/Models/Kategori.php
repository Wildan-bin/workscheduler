<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'name',
        'description',
        // Add other fields as needed
    ];

    public function produkKategori()
    {
        return $this->hasMany(ProdukKategori::class);
    }
}

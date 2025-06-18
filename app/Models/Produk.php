<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Produk extends Model
{
    protected $fillable = [
        'id',
        'name', 
        'description', 
        'image'
    ];

    public function variasis()
    {
        return $this->hasMany(ProdukVariasi::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'produk_kategoris', 'produk_id', 'kategori_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
        );
    }
}


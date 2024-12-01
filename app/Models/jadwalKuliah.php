<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalKuliah extends Model
{
    //
    use HasFactory;

    protected $table = 'jadwal_kuliah';

    protected $fillable = [
        'pegawai_id',
        'hari',
        'jam_selesai',
    ];

    public function pegawais(): BelongsTo
    {
        return $this->belongsTo(Pegawais::class, 'pegawai_id', 'id');
    }
}

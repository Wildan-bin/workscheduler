<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensi';

    protected $fillable = [
        'pegawai_id',
        'tanggal',
        'status_kehadiran',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

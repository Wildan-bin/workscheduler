<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    //
    protected $fillable = ['nama', 'email', 'ketersediaan'];

    // Relasi ke model Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}

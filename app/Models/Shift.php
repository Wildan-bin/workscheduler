<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    //
    protected $fillable = ['nama_shift', 'mulai', 'selesai'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}

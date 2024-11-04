<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
  //
  protected $fillable = ['pegawai_id', 'shift_id', 'tanggal'];

  // Relasi ke Pegawai
  public function pegawai()
  {
    return $this->belongsTo(Pegawai::class);
  }

  // Relasi ke Shift
  public function shift()
  {
    return $this->belongsTo(Shift::class);
  }
}

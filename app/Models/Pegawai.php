<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pegawais';

    //
    protected $fillable = [
        'nama',
        'email',
        'password',
        'jabatan'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke model Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }
}

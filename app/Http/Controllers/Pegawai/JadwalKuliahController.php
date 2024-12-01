<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\Pegawais;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        // Mengambil semua data pegawai beserta jadwal kuliah yang terkait
        $pegawais = Pegawais::with('jadwalKuliah')->get();

        // Return ke view jadwal kuliah
        return view('manajer.jadwalkuliah', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $data = $request->input('jadwal');

        foreach ($data as $index => $jadwal) {
            // Menyimpan jadwal kuliah
            JadwalKuliah::create([
                'pegawai_id' => Auth::user()->id, // Assuming the user is logged in
                'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][$index],
                'jam_selesai' => $jadwal['jam_selesai'],
            ]);
        }

        return redirect()->route('penjadwalan')->with('success', 'Jadwal kuliah berhasil disimpan!');
    }
}

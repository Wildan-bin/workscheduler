<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Jadwal;
use App\Models\Pegawais;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    //
    public function index()
    {
        $pegawais = Pegawais::all();
        $shifts = Shift::all();
        return view('jadwal.index', compact('pegawais', 'shifts'));
    }

    public function create()
    {
        $pegawais = Pegawais::all();
        $shifts = Shift::all();
        return view('jadwal.create', compact('pegawais', 'shifts'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        // Ambil data ketersediaan pegawai
        $pegawai = Pegawais::find($input['pegawai_id']);
        $ketersediaan = json_decode($pegawai->ketersediaan, true);

        // Algoritma sederhana untuk mencocokkan ketersediaan
        $tanggal = $input['tanggal'];
        $shift = Shift::find($input['shift_id']);

        // Memastikan bahwa pegawai tersedia pada tanggal dan waktu shift
        if (in_array($tanggal, $ketersediaan['tanggal']) && $this->checkAvailability($ketersediaan, $shift)) {
            // Jika tersedia, simpan jadwal
            Jadwal::create([
                'pegawai_id' => $input['pegawai_id'],
                'shift_id' => $input['shift_id'],
                'tanggal' => $input['tanggal']
            ]);
            return redirect()->back()->with('success', 'Jadwal berhasil dibuat.');
        } else {
            return redirect()->back()->with('error', 'Pegawai tidak tersedia pada tanggal atau waktu tersebut.');
        }
    }

    private function checkAvailability($ketersediaan, $shift)
    {
        // Cek apakah pegawai tersedia di waktu shift
        foreach ($ketersediaan['jam'] as $jam) {
            if ($jam['mulai'] <= $shift->mulai && $jam['selesai'] >= $shift->selesai) {
                return true;
            }
        }
        return false;
    }
}

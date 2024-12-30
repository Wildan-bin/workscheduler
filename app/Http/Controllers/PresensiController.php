<?php

namespace App\Http\Controllers;

use App\Models\Pegawais;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function rekapKehadiran()
    {
        // Ambil data pegawai yang sedang login
        $pegawai = Auth::user()->id; // Pastikan Anda menggunakan Auth untuk login pegawai

        // Ambil data kehadiran berdasarkan pegawai yang login
        $kehadiran = $pegawai->kehadiran()->orderBy('tanggal', 'desc')->get();

        // Return ke view rekap kehadiran
        return view('pegawai.rekapkehadiran', compact('pegawai', 'kehadiran'));
    }

    public function index(Request $request)
    {
        // Ambil bulan yang dipilih dari input (format: "YYYY-MM")
        $selectedMonth = $request->query('month', now()->format('Y-m')); // Default: bulan ini

        // Filter pegawai dan jadwal kerja sesuai bulan
        $pegawais = Pegawais::whereHas('jadwalKerja', function ($query) use ($selectedMonth) {
            $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$selectedMonth]);
        })->with(['jadwalKerja' => function ($query) use ($selectedMonth) {
            $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$selectedMonth]);
        }])->get();

        // Return ke view dengan data pegawai dan bulan yang dipilih
        return view('manajer.jadwalpegawai', compact('pegawais', 'selectedMonth'));
    }


    public function savePresence(Request $request)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha',
        ]);

        Presensi::create([
            'pegawai_id' => $validated['pegawai_id'],
            'tanggal' => $validated['tanggal'],
            'status' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil disimpan.');
    }
}

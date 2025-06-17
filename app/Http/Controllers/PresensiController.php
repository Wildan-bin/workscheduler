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
        $pegawai = Pegawais::find(Auth::id()); // Pastikan Anda menggunakan Auth untuk login pegawai

        // Ambil data kehadiran berdasarkan pegawai yang login
        $kehadiran = $pegawai->presensi()->orderBy('tanggal', 'desc')->get();

        // Return ke view rekap kehadiran
        return view('pegawai.rekapkehadiran', compact('pegawai', 'kehadiran'));
    }

    public function adminRekapKehadiran()
    {
        $kehadiran = Presensi::with('pegawai')->get();

        // Return ke view rekap kehadiran
        return view('manajer.rekapkehadiran', compact('kehadiran'));
    }

    public function index(Request $request)
    {
        $selectedMonth = $request->query('month', now()->format('Y-m')); // Default: bulan ini
        $selectedPegawaiId = $request->query('pegawai_id', null);

        $allPegawais = Pegawais::all();

        $query = Pegawais::query();

        if ($selectedPegawaiId) {
            $query->where('id', $selectedPegawaiId);
        }

        $pegawaisFiltered = $query->whereHas('jadwalKerja', function ($query) use ($selectedMonth) {
            $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$selectedMonth]);
        })->with(['jadwalKerja' => function ($query) use ($selectedMonth) {
            $query->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$selectedMonth]);
        }])->get();

        return view('manajer.jadwalpegawai', [
            'pegawais' => $pegawaisFiltered,
            'allPegawais' => $allPegawais,
            'selectedMonth' => $selectedMonth,
            'selectedPegawaiId' => $selectedPegawaiId,
        ]);
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
            'status_kehadiran' => $validated['status'],
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil disimpan.');
    }
}

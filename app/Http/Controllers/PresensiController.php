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

    public function adminRekapKehadiran(Request $request)
    {
        $selectedPegawaiId = $request->query('pegawai_id', null);
        $allPegawais = Pegawais::all();

        $query = Presensi::with('pegawai');

        if ($selectedPegawaiId) {
            $query->where('pegawai_id', $selectedPegawaiId);
        }

        $kehadiran = $query->orderBy('tanggal', 'desc')->get();

        // Return ke view rekap kehadiran
        return view('manajer.rekapkehadiran', compact('kehadiran', 'allPegawais', 'selectedPegawaiId'));
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

        // Query presensi for the selected month and pegawai(s)
        $presensiQuery = \App\Models\Presensi::query();
        if ($selectedPegawaiId) {
            $presensiQuery->where('pegawai_id', $selectedPegawaiId);
        }
        $presensi = $presensiQuery->whereRaw("DATE_FORMAT(tanggal, '%Y-%m') = ?", [$selectedMonth])->get();

        // Map presensi by pegawai_id and tanggal for quick lookup
        $presensiMap = [];
        foreach ($presensi as $p) {
            $presensiMap[$p->pegawai_id][$p->tanggal] = $p;
        }

        return view('manajer.jadwalpegawai', [
            'pegawais' => $pegawaisFiltered,
            'allPegawais' => $allPegawais,
            'selectedMonth' => $selectedMonth,
            'selectedPegawaiId' => $selectedPegawaiId,
            'presensiMap' => $presensiMap,
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

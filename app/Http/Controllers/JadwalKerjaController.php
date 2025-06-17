<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pegawais;
use App\Models\JadwalKerja;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;

class JadwalKerjaController extends Controller
{
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

        // Return ke view jadwal kuliah
        return view('pegawai.jadwal', compact('pegawais', 'selectedMonth'));
    }

    public function buatJadwal(Request $request)
    {
        $pegawai = Pegawais::with('jadwalKuliah')->findOrFail($request->pegawai_id);

        $startDate = Carbon::tomorrow(); // Mulai dari besok
        $endDate = $startDate->copy()->endOfMonth(); // Akhir bulan sesuai bulan startDate

        $tanggalKerja = $startDate->copy();
        while ($tanggalKerja->lte($endDate)) {
            $hari = $tanggalKerja->format('l'); // Nama hari dalam bahasa Inggris
            $hariIndo = [
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                'Sunday' => 'Minggu'
            ][$hari];

            $jadwalKuliah = $pegawai->jadwalKuliah->firstWhere('hari', $hariIndo);

            if ($jadwalKuliah) {
                if ($jadwalKuliah->jam_selesai === '00:00:00') {
                    // Jika hari libur
                    JadwalKerja::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal' => $tanggalKerja->toDateString(),
                        'jam_mulai' => '00:00:00',
                        'jam_selesai' => '00:00:00',
                    ]);
                } else {
                    $jamSelesaiKuliah = Carbon::createFromFormat('H:i:s', $jadwalKuliah->jam_selesai);
                    $jamMulaiKerja = $jamSelesaiKuliah->copy()->addMinutes(30);

                    if ($jamMulaiKerja->hour < 15) {
                        $jamMulaiKerja = Carbon::createFromTime(15, 0, 0);
                    }

                    JadwalKerja::create([
                        'pegawai_id' => $pegawai->id,
                        'tanggal' => $tanggalKerja->toDateString(),
                        'jam_mulai' => $jamMulaiKerja->toTimeString(),
                        'jam_selesai' => '21:00:00', // Atur jam selesai kerja default
                    ]);
                }
            }

            $tanggalKerja->addDay();
        }

        // Flash message sukses
        session()->flash('success', 'Jadwal kerja berhasil dibuat!');

        return redirect()->back();
    }
}

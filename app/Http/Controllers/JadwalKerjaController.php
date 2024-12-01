<?php

namespace App\Http\Controllers;

use App\Models\Pegawais;
use App\Models\JadwalKuliah;
use App\Models\JadwalKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalKerjaController extends Controller
{
    public function buatJadwal(Request $request)
    {
        // Validasi input untuk memastikan pegawai_id dikirim
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
        ]);

        $pegawaiId = $request->pegawai_id;

        // Ambil jadwal kuliah pegawai
        $jadwalKuliah = JadwalKuliah::where('pegawai_id', $pegawaiId)->get();

        if ($jadwalKuliah->isEmpty()) {
            return redirect()->back()->with('error', 'Pegawai ini tidak memiliki jadwal kuliah.');
        }

        // Mulai dari tanggal besok hingga satu bulan ke depan
        $startDate = Carbon::now()->addDay();
        $endDate = $startDate->copy()->endOfMonth();

        // Loop melalui semua tanggal dari besok hingga akhir bulan
        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            // Cari jadwal kuliah pada hari tertentu
            $hariIni = $currentDate->locale('id')->isoFormat('dddd'); // Contoh: "Senin", "Selasa"
            $jadwalHariIni = $jadwalKuliah->where('hari', $hariIni)->first();

            if ($jadwalHariIni) {
                // Tentukan jam mulai kerja
                $jamSelesaiKuliah = Carbon::createFromTimeString($jadwalHariIni->jam_selesai);
                $jamMulaiKerja = $jamSelesaiKuliah->addMinutes(30); // Tambahkan 30 menit

                // Jika jam selesai kuliah sebelum atau sama dengan 14:30, mulai kerja pukul 15:00
                if ($jamSelesaiKuliah->lessThanOrEqualTo(Carbon::createFromTimeString('14:30'))) {
                    $jamMulaiKerja = Carbon::createFromTimeString('15:00');
                }

                // Tambahkan jadwal kerja ke database
                JadwalKerja::create([
                    'pegawai_id' => $pegawaiId,
                    'tanggal' => $currentDate->toDateString(),
                    'jam_mulai' => $jamMulaiKerja->toTimeString(),
                    'jam_selesai' => '21:00', // Contoh: jam kerja selesai pukul 21:00
                ]);
            }

            // Lanjut ke tanggal berikutnya
            $currentDate->addDay();
        }

        return redirect()->back()->with('success', 'Jadwal kerja berhasil dibuat untuk satu bulan!');
    }
}

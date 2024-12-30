<?php

namespace App\Http\Controllers\Pegawai;

use App\Models\Pegawais;
use App\Models\JadwalKerja;
use App\Models\JadwalKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalKuliahController extends Controller
{
    public function index()
    {
        // Mengambil semua data pegawai beserta jadwal kuliah yang terkait
        $pegawais = Pegawais::whereHas('jadwalKuliah')->with('jadwalKuliah')->get();

        // Return ke view jadwal kuliah
        return view('manajer.jadwalkuliah', compact('pegawais'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'jadwal.*.jam_selesai' => 'nullable|date_format:H:i',
    //         'jadwal.*.libur' => 'nullable|boolean',
    //     ]);

    //     $jadwal = $request->input('jadwal');

    //     // Cek apakah ada lebih dari satu hari yang dipilih sebagai libur
    //     $hariLibur = array_filter($jadwal, function ($item) {
    //         return isset($item['libur']) && $item['libur'] == 1;
    //     });

    //     if (count($hariLibur) > 1) {
    //         return redirect()->back()->with('error', 'Hanya satu hari yang boleh dipilih sebagai libur.');
    //     }

    //     // Simpan setiap jadwal
    //     foreach ($jadwal as $index => $data) {
    //         JadwalKuliah::create([
    //             'pegawai_id' => Auth::user()->id,
    //             'hari' => ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][$index],
    //             'jam_selesai' => isset($data['libur']) && $data['libur'] == 1 ? '00:00:00' : $data['jam_selesai'],
    //         ]);
    //     }

    //     return redirect()->route('penjadwalan')->with('success', 'Jadwal kuliah berhasil disimpan.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jadwal.*.jam_selesai' => 'nullable|date_format:H:i',
            'jadwal.*.libur' => 'nullable|boolean',
        ]);

        $jadwal = $request->input('jadwal');

        // Cek apakah ada lebih dari satu hari yang dipilih sebagai libur
        $hariLibur = array_filter($jadwal, function ($item) {
            return isset($item['libur']) && $item['libur'] == 1;
        });

        if (count($hariLibur) > 1) {
            return redirect()->back()->with('error', 'Hanya satu hari yang boleh dipilih sebagai libur.');
        }

        // Ambil data pegawai yang sedang login
        $pegawaiId = Auth::user()->id;

        // Simpan jadwal kuliah
        foreach ($jadwal as $index => $data) {
            $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'][$index];
            $jamSelesai = isset($data['libur']) && $data['libur'] == 1 ? '00:00:00' : $data['jam_selesai'];

            JadwalKuliah::create([
                'pegawai_id' => $pegawaiId,
                'hari' => $hari,
                'jam_selesai' => $jamSelesai,
            ]);
        }

        // Tentukan rentang tanggal untuk jadwal kerja
        $startDate = Carbon::tomorrow(); // Mulai dari besok
        $currentMonth = Carbon::now()->month;

        // Jika bulan saat ini <= Juni, buat jadwal hingga akhir Juni. Jika > Juni, buat hingga akhir Desember.
        $endDate = $currentMonth <= 6
            ? Carbon::create(Carbon::now()->year, 6, 30) // Akhir Juni
            : Carbon::create(Carbon::now()->year, 12, 31); // Akhir Desember

        $tanggalKerja = $startDate->copy();

        // Iterasi tanggal
        while ($tanggalKerja->lte($endDate)) {
            $hariTanggal = $tanggalKerja->format('l'); // Nama hari dalam bahasa Inggris
            $hariIndo = [
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
                'Sunday' => 'Minggu',
            ][$hariTanggal];

            // Cari jadwal kuliah yang sesuai dengan hari ini
            $jadwalKuliah = JadwalKuliah::where('pegawai_id', $pegawaiId)
                ->where('hari', $hariIndo)
                ->first();

            if ($jadwalKuliah) {
                if ($jadwalKuliah->jam_selesai === '00:00:00') {
                    // Jika hari libur
                    JadwalKerja::create([
                        'pegawai_id' => $pegawaiId,
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
                        'pegawai_id' => $pegawaiId,
                        'tanggal' => $tanggalKerja->toDateString(),
                        'jam_mulai' => $jamMulaiKerja->toTimeString(),
                        'jam_selesai' => '21:00:00', // Default jam selesai kerja
                    ]);
                }
            }

            $tanggalKerja->addDay(); // Lanjutkan ke hari berikutnya
        }

        // Redirect dengan pesan sukses
        return redirect()->route('penjadwalan')->with('success', 'Jadwal kuliah dan jadwal kerja berhasil dibuat hingga ' . $endDate->format('d F Y') . '!');
    }
}

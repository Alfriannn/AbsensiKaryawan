<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class BerandaController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->first();

        // Statistik absensi
        $statistik = [
            'hadir' => 0,
            'izin' => 0,
            'cuti' => 0,
            'telat' => 0,
        ];
        if ($karyawan) {
            $statistik['hadir'] = \App\Models\Absensi::where('karyawan_id', $karyawan->id)->where('keterangan', 'Hadir')->count();
            $statistik['izin'] = \App\Models\Absensi::where('karyawan_id', $karyawan->id)->where('keterangan', 'Izin')->count();
            $statistik['cuti'] = \App\Models\Cuti::where('karyawan_id', $karyawan->id)->where('status', 'approved')->count();
            $statistik['telat'] = \App\Models\Absensi::where('karyawan_id', $karyawan->id)->where('keterangan', 'Telat')->count();
        }

        $absensiHariIni = $karyawan
            ? Absensi::where('karyawan_id', $karyawan->id)->where('tanggal', date('Y-m-d'))->first()
            : null;

        // Ambil 7 absensi terakhir milik karyawan ini
        $riwayatAbsensi = $karyawan
            ? Absensi::where('karyawan_id', $karyawan->id)
                ->orderBy('tanggal', 'desc')
                ->limit(7)
                ->get()
            : collect();

        // Ambil notifikasi cuti (status selain pending, urut terbaru)
        $notifikasiCuti = $karyawan
            ? \App\Models\Cuti::where('karyawan_id', $karyawan->id)
                ->where('status', '!=', 'pending')
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get()
            : collect();

        $pengumuman = \App\Models\Pengumuman::orderBy('created_at', 'desc')->limit(3)->get();

        return view('beranda.beranda', compact('karyawan', 'absensiHariIni', 'riwayatAbsensi', 'notifikasiCuti', 'statistik', 'pengumuman'));
    }

    public function absen(Request $request)
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->first();
        if (!$karyawan) {
            return back()->with('error', 'Data karyawan tidak ditemukan.');
        }

        $absensi = Absensi::firstOrCreate(
            [
                'karyawan_id' => $karyawan->id,
                'tanggal' => date('Y-m-d')
            ],
            [
                'jam_masuk' => now()->format('H:i:s'),
                'keterangan' => $request->keterangan
            ]
        );

        // Jika sudah check-in, update jam_keluar
        if ($absensi->jam_masuk && !$absensi->jam_keluar && $request->has('checkout')) {
            $absensi->jam_keluar = now()->format('H:i:s');
            $absensi->save();
            return back()->with('success', 'Check-out berhasil!');
        }

        return back()->with('success', 'Check-in berhasil!');
    }

    public function slipAbsensi(Request $request)
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->first();
        $bulan = $request->bulan ?? date('m');
        return Excel::download(new AbsensiExport($karyawan->id, $bulan), 'slip-absensi.xlsx');
    }
}

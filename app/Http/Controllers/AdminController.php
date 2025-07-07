<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function dashboard()
    {
        $totalKaryawan = \App\Models\Karyawan::count();
        $hadirHariIni = \App\Models\Absensi::where('tanggal', date('Y-m-d'))->where('keterangan', 'Hadir')->count();
        $izinHariIni = \App\Models\Absensi::where('tanggal', date('Y-m-d'))->where('keterangan', 'Izin')->count();
        $cutiHariIni = \App\Models\Cuti::whereDate('tanggal_mulai', '<=', date('Y-m-d'))
            ->whereDate('tanggal_selesai', '>=', date('Y-m-d'))
            ->where('status', 'approved')->count();
        $telatHariIni = \App\Models\Absensi::where('tanggal', date('Y-m-d'))->where('keterangan', 'Telat')->count();

        return view('admin.dashboard', compact('totalKaryawan', 'hadirHariIni', 'izinHariIni', 'cutiHariIni', 'telatHariIni'));
    }
}

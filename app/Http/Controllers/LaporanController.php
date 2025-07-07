<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $karyawans = Karyawan::all();
        $query = Absensi::with('karyawan');

        // Filter berdasarkan karyawan dan tanggal
        if ($request->karyawan_id) {
            $query->where('karyawan_id', $request->karyawan_id);
        }
        if ($request->tanggal_mulai && $request->tanggal_selesai) {
            $query->whereBetween('tanggal', [$request->tanggal_mulai, $request->tanggal_selesai]);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->get();

        return view('laporan.absensi', compact('absensis', 'karyawans'));
    }
}

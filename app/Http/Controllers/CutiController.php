<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::where('email', Auth::user()->email)->first();
        $cutis = $karyawan ? Cuti::where('karyawan_id', $karyawan->id)->orderBy('created_at', 'desc')->get() : collect();
        return view('cuti.index', compact('cutis'));
    }

    public function create()
    {
        return view('cuti.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);
        $karyawan = Karyawan::where('email', Auth::user()->email)->first();
        Cuti::create([
            'karyawan_id' => $karyawan->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);
        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti/izin berhasil dikirim.');
    }

    public function adminIndex()
    {
        $cutis = Cuti::with('karyawan')->orderBy('created_at', 'desc')->get();
        return view('cuti.admin_index', compact('cutis'));
    }

    public function approve(Cuti $cuti)
    {
        $cuti->status = 'approved';
        $cuti->save();
        return back()->with('success', 'Cuti disetujui.');
    }

    public function reject(Cuti $cuti)
    {
        $cuti->status = 'rejected';
        $cuti->save();
        return back()->with('success', 'Cuti ditolak.');
    }
}

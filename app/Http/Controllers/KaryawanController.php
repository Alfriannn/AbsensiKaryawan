<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Absensi; // Tambahkan di atas jika belum ada
use Intervention\Image\Facades\Image;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans',
            'jabatan' => 'required',
        ]);
        Karyawan::create($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email,'.$karyawan->id,
            'jabatan' => 'required',
        ]);
        $karyawan->update($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }

    public function riwayatAbsensi($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $absensis = $karyawan->absensis()->orderBy('tanggal', 'desc')->get();
        return view('karyawan.riwayat_absensi', compact('karyawan', 'absensis'));
    }

    public function editProfil()
    {
        $karyawan = \App\Models\Karyawan::where('email', auth()->user()->email)->first();
        return view('karyawan.edit_profil', compact('karyawan'));
    }

    public function updateProfil(Request $request)
    {
        $karyawan = \App\Models\Karyawan::where('email', auth()->user()->email)->first();
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto && file_exists(storage_path('app/public/foto_karyawan/'.$karyawan->foto))) {
                unlink(storage_path('app/public/foto_karyawan/'.$karyawan->foto));
            }
            $file = $request->file('foto');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $img = Image::make($file)->fit(300, 300); // crop jadi 300x300 persegi
            $img->save(storage_path('app/public/foto_karyawan/'.$filename));
            $karyawan->foto = $filename;
        }

        $karyawan->nama = $request->nama;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->save();

        return redirect()->route('beranda')->with('success', 'Profil berhasil diperbarui.');
    }
}

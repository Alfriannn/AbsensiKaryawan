<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $karyawan = auth()->user()->karyawan; // atau sesuai relasi

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $karyawan->nama = $request->nama;
        $karyawan->jabatan = $request->jabatan;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto && file_exists(storage_path('app/public/foto_karyawan/'.$karyawan->foto))) {
                unlink(storage_path('app/public/foto_karyawan/'.$karyawan->foto));
            }
            $file = $request->file('foto');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->storeAs('public/foto_karyawan', $filename);
            $karyawan->foto = $filename;
        }

        $karyawan->save();

        return redirect()->route('beranda')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

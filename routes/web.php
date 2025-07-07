<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('beranda');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin,hr'])->group(function () {
    // route khusus admin/hr
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('absensi', AbsensiController::class);

    // Route riwayat absensi per karyawan
    Route::get('karyawan/{karyawan}/absensi', [KaryawanController::class, 'riwayatAbsensi'])->name('karyawan.absensi');
    Route::get('laporan/absensi', [LaporanController::class, 'index'])->name('laporan.absensi');
    Route::get('admin/cuti', [CutiController::class, 'adminIndex'])->name('admin.cuti.index');
    Route::post('admin/cuti/{cuti}/approve', [CutiController::class, 'approve'])->name('admin.cuti.approve');
    Route::post('admin/cuti/{cuti}/reject', [CutiController::class, 'reject'])->name('admin.cuti.reject');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // CRUD hanya untuk admin
    Route::resource('pengumuman', PengumumanController::class);
});

// Karyawan & umum hanya bisa lihat pengumuman lewat route khusus
Route::get('/info', [PengumumanController::class, 'index'])->name('info');

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::post('/beranda/absen', [BerandaController::class, 'absen'])->name('beranda.absen');
    Route::resource('cuti', CutiController::class)->only(['index', 'create', 'store']);
    Route::get('/profil', [KaryawanController::class, 'editProfil'])->name('profil.edit');
    Route::post('/profil', [KaryawanController::class, 'updateProfil'])->name('profil.update');
    Route::get('/slip-absensi', [BerandaController::class, 'slipAbsensi'])->name('slip.absensi');
});

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
    ->name('admin.dashboard')
    ->middleware(['auth', 'role:admin']);

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'role:admin']);

require __DIR__.'/auth.php';

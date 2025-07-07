<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiExport implements FromView
{
    protected $karyawan_id;
    protected $bulan;

    public function __construct($karyawan_id, $bulan)
    {
        $this->karyawan_id = $karyawan_id;
        $this->bulan = $bulan;
    }

    public function view(): View
    {
        $absensis = Absensi::where('karyawan_id', $this->karyawan_id)
            ->whereMonth('tanggal', $this->bulan)
            ->get();

        return view('absensi.slip', [
            'absensis' => $absensis
        ]);
    }
}

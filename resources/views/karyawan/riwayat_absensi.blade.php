<!-- filepath: resources/views/karyawan/riwayat_absensi.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Riwayat Absensi: {{ $karyawan->nama }}</h1>
<a href="{{ route('karyawan.index') }}">Kembali ke Daftar Karyawan</a>
<table border="1" style="margin-top:20px;">
    <tr>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Keterangan</th>
    </tr>
    @forelse($absensis as $absensi)
    <tr>
        <td>{{ $absensi->tanggal }}</td>
        <td>{{ $absensi->jam_masuk }}</td>
        <td>{{ $absensi->jam_keluar }}</td>
        <td>{{ $absensi->keterangan }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="4">Belum ada data absensi.</td>
    </tr>
    @endforelse
</table>
@endsection
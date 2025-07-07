<!-- filepath: resources/views/laporan/absensi.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Laporan Absensi</h1>
<form method="GET" action="{{ route('laporan.absensi') }}">
    <label>Karyawan:</label>
    <select name="karyawan_id">
        <option value="">Semua</option>
        @foreach($karyawans as $karyawan)
            <option value="{{ $karyawan->id }}" {{ request('karyawan_id') == $karyawan->id ? 'selected' : '' }}>
                {{ $karyawan->nama }}
            </option>
        @endforeach
    </select>
    <label>Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}">
    <label>Tanggal Selesai:</label>
    <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}">
    <button type="submit">Filter</button>
</form>

<table border="1" style="margin-top:20px;">
    <tr>
        <th>Nama Karyawan</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Keterangan</th>
    </tr>
    @forelse($absensis as $absensi)
    <tr>
        <td>{{ $absensi->karyawan->nama ?? '-' }}</td>
        <td>{{ $absensi->tanggal }}</td>
        <td>{{ $absensi->jam_masuk }}</td>
        <td>{{ $absensi->jam_keluar }}</td>
        <td>{{ $absensi->keterangan }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Tidak ada data.</td>
    </tr>
    @endforelse
</table>
@endsection
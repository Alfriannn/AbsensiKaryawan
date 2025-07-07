<!-- filepath: resources/views/absensi/index.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Daftar Absensi</h1>
<a href="{{ route('absensi.create') }}">Tambah Absensi</a>
@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
<table border="1">
    <tr>
        <th>Nama Karyawan</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
    @foreach($absensis as $absensi)
    <tr>
        <td>{{ $absensi->karyawan->nama ?? '-' }}</td>
        <td>{{ $absensi->tanggal }}</td>
        <td>{{ $absensi->jam_masuk }}</td>
        <td>{{ $absensi->jam_keluar }}</td>
        <td>{{ $absensi->keterangan }}</td>
        <td>
            <a href="{{ route('absensi.edit', $absensi) }}">Edit</a>
            <form action="{{ route('absensi.destroy', $absensi) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
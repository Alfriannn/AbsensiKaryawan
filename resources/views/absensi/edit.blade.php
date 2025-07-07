<!-- filepath: resources/views/absensi/edit.blade.php -->
@extends('layouts.app')

@section('content')
<h1>Edit Absensi</h1>
<form action="{{ route('absensi.update', $absensi) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Karyawan:</label>
    <select name="karyawan_id" required>
        <option value="">-- Pilih Karyawan --</option>
        @foreach($karyawans as $karyawan)
            <option value="{{ $karyawan->id }}" {{ old('karyawan_id', $absensi->karyawan_id) == $karyawan->id ? 'selected' : '' }}>
                {{ $karyawan->nama }}
            </option>
        @endforeach
    </select>
    @error('karyawan_id') <div>{{ $message }}</div> @enderror
    <br>
    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="{{ old('tanggal', $absensi->tanggal) }}" required>
    @error('tanggal') <div>{{ $message }}</div> @enderror
    <br>
    <label>Jam Masuk:</label>
    <input type="time" name="jam_masuk" value="{{ old('jam_masuk', $absensi->jam_masuk) }}" required>
    @error('jam_masuk') <div>{{ $message }}</div> @enderror
    <br>
    <label>Jam Keluar:</label>
    <input type="time" name="jam_keluar" value="{{ old('jam_keluar', $absensi->jam_keluar) }}">
    @error('jam_keluar') <div>{{ $message }}</div> @enderror
    <br>
    <label>Keterangan:</label>
    <input type="text" name="keterangan" value="{{ old('keterangan', $absensi->keterangan) }}">
    @error('keterangan') <div>{{ $message }}</div> @enderror
    <br>
    <button type="submit">Update</button>
    <a href="{{ route('absensi.index') }}">Kembali</a>
</form>
@endsection
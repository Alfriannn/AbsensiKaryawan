@extends('layouts.app')

@section('content')
<h1>Ajukan Cuti/Izin</h1>
<form action="{{ route('cuti.store') }}" method="POST">
    @csrf
    <label>Tanggal Mulai:</label>
    <input type="date" name="tanggal_mulai" required>
    <br>
    <label>Tanggal Selesai:</label>
    <input type="date" name="tanggal_selesai" required>
    <br>
    <label>Alasan:</label>
    <input type="text" name="alasan" required>
    <br>
    <button type="submit">Ajukan</button>
    <a href="{{ route('cuti.index') }}">Kembali</a>
</form>
@endsection
<!-- filepath: [create.blade.php](http://_vscodecontentref_/3) -->
@extends('layouts.app')
@section('content')
<h1>Tambah Pengumuman</h1>
<form action="{{ route('pengumuman.store') }}" method="POST">
    @csrf
    <label>Judul:</label>
    <input type="text" name="judul" required>
    <br>
    <label>Isi:</label>
    <textarea name="isi" required></textarea>
    <br>
    <button type="submit">Simpan</button>
    <a href="{{ route('pengumuman.index') }}">Kembali</a>
</form>
@endsection
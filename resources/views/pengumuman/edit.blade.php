<!-- filepath: [edit.blade.php](http://_vscodecontentref_/4) -->
@extends('layouts.app')
@section('content')
<h1>Edit Pengumuman</h1>
<form action="{{ route('pengumuman.update', $pengumuman) }}" method="POST">
    @csrf
    @method('PUT')
    <label>Judul:</label>
    <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" required>
    <br>
    <label>Isi:</label>
    <textarea name="isi" required>{{ old('isi', $pengumuman->isi) }}</textarea>
    <br>
    <button type="submit">Update</button>
    <a href="{{ route('pengumuman.index') }}">Batal</a>
</form>
@endsection
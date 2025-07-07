@extends('layouts.app')
@section('content')
<h1>Daftar Pengumuman</h1>
<a href="{{ route('pengumuman.create') }}">Tambah Pengumuman</a>
@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif
<table border="1" cellpadding="5">
    <tr>
        <th>Judul</th>
        <th>Isi</th>
        <th>Aksi</th>
    </tr>
    @foreach($pengumuman as $item)
    <tr>
        <td>{{ $item->judul }}</td>
        <td>{{ $item->isi }}</td>
        <td>
            <a href="{{ route('pengumuman.show', $item) }}">Lihat</a>
            <a href="{{ route('pengumuman.edit', $item) }}">Edit</a>
            <form action="{{ route('pengumuman.destroy', $item) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
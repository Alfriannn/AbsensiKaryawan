@extends('layouts.app')

@section('content')
<h1>Daftar Pengajuan Cuti/Izin</h1>
@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif
<table border="1" cellpadding="5">
    <tr>
        <th>Nama Karyawan</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Alasan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @foreach($cutis as $cuti)
    <tr>
        <td>{{ $cuti->karyawan->nama ?? '-' }}</td>
        <td>{{ $cuti->tanggal_mulai }}</td>
        <td>{{ $cuti->tanggal_selesai }}</td>
        <td>{{ $cuti->alasan }}</td>
        <td>{{ ucfirst($cuti->status) }}</td>
        <td>
            @if($cuti->status == 'pending')
                <form action="{{ route('admin.cuti.approve', $cuti) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Setujui cuti ini?')">Setujui</button>
                </form>
                <form action="{{ route('admin.cuti.reject', $cuti) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" onclick="return confirm('Tolak cuti ini?')">Tolak</button>
                </form>
            @else
                -
            @endif
        </td>
    </tr>
    @endforeach
</table>
@endsection
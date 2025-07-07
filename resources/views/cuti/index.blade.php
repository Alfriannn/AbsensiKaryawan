@extends('layouts.app')

@section('content')
<h1>Riwayat Pengajuan Cuti/Izin</h1>
<a href="{{ route('cuti.create') }}">Ajukan Cuti/Izin</a>
@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif
<table border="1" cellpadding="5">
    <tr>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Alasan</th>
        <th>Status</th>
    </tr>
    @forelse($cutis as $cuti)
        <tr>
            <td>{{ $cuti->tanggal_mulai }}</td>
            <td>{{ $cuti->tanggal_selesai }}</td>
            <td>{{ $cuti->alasan }}</td>
            <td>{{ ucfirst($cuti->status) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="4">Belum ada pengajuan cuti/izin.</td>
        </tr>
    @endforelse
</table>
@endsection
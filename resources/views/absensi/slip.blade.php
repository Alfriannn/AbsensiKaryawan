<table>
    <tr>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Keterangan</th>
    </tr>
    @foreach($absensis as $absensi)
    <tr>
        <td>{{ $absensi->tanggal }}</td>
        <td>{{ $absensi->jam_masuk }}</td>
        <td>{{ $absensi->jam_keluar }}</td>
        <td>{{ $absensi->keterangan }}</td>
    </tr>
    @endforeach
</table>
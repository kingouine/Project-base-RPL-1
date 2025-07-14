<h1 align="center">Data Evaluasi Kinerja</h1>
<table width="100%">
    <thead>
    <tr>
        <th colspan="5" align="center">
            Di Cetak : Tanggal {{ $tanggal }} Pukul : {{ $jam }}
        </th>
    </tr>
    <table width="150%" border="1px" style="border-collapse:collapse">
    <tr>
        <th width="20" align="center">No</th>
        <th width="20" align="center">Nama</th>
        <th width="20" align="center">Periode</th>
        <th width="20" align="center">Total Jam</th>
        <th width="20" align="center">Jumlah Tugas Selesai</th>
        <th width="20" align="center">Nilai Akhir</th>
        <th width="20" align="center">Penilaian</th>
    </tr>
    </thead>
            @foreach ($evaluasi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->user->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($item->periode)->format('F Y') }}</td>
                <td>{{ $item->total_jam_kerja }} jam</td>
                <td>{{ $item->jumlah_tugas_selesai }}</td>
                <td>{{ $item->nilai_akhir }}/20</td>
                <td>{{ $item->penilaian }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
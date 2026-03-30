<table>
    <thead>
        <tr>
            <th colspan="6" align="center">Data Evaluasi Kinerja</th>
        </tr>
        <tr>
            <th colspan="6" align="center">
                Dicetak: Tanggal {{ $tanggal }} Pukul: {{ $jam }}
            </th>
        </tr>
        <tr>
            <th width="10" align="center">No</th>
            <th width="25" align="center">Nama</th>
            <th width="20" align="center">Periode</th>
            <th width="20" align="center">Total Jam Kerja</th>
            <th width="20" align="center">Jumlah Tugas</th>
            <th width="20" align="center">Penilaian</th>
            <th width="20" align="center">Nilai Akhir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluasi as $e)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $e->user->nama }}</td>
                <td align="center">{{ \Carbon\Carbon::parse($e->periode)->format('F Y') }}</td>
                <td align="center">{{ $e->total_jam_kerja }} jam</td>
                <td align="center">{{ $e->jumlah_tugas_selesai }}</td>
                <td align="center">{{ $e->penilaian }}</td>
                <td align="center">{{ $e->nilai_akhir }}/20</td>
            </tr>
        @endforeach
    </tbody>
</table>

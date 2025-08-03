<h1 align="text-center">Data Tugas</h1>

<p align="text-center">
    Dicetak pada Tanggal {{ $tanggal }} Pukul {{ $jam }}
</p>

<table width="100%" border="1" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th width="20" align="center">No</th>
            <th width="20" align="center">Nama</th>
            <th width="20" align="center">Tugas</th>
            <th width="20" align="center">Tanggal Mulai</th>
            <th width="20" align="center">Tanggal Selesai</th>
            <th width="20" align="center">Status Tugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tugas as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td align="center">{{ $item->tugas ?? '-' }}</td>
                <td>{{ $item->tanggal_mulai }}</td>
                <td>{{ $item->tanggal_selesai ?? '-' }}</td>
                @if ($item->status == 0)
                <td>Belum Selesai</td>
                @elseif ($item->status == 1) 
                <td>Sedang Dikerjakan</td>
                @elseif ($item->status == 2)    
                <td>Selesai</td>
                @else ()
                <td>Proses Validasi</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

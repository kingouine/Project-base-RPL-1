<h1 align="text-center">Data Kehadiran</h1>

<p align="text-center">
    Dicetak pada Tanggal {{ $tanggal }} Pukul {{ $jam }}
</p>

<table width="100%" border="1" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th width="20" align="center">No</th>
            <th width="20" align="center">Nama</th>
            <th width="20" align="center">Jabatan</th>
            <th width="20" align="center">Clock-In</th>
            <th width="20" align="center">Clock-Out</th>
            <th width="20" align="center">Total Duration</th>
            <th width="20" align="center">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kehadirans as $item)
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->user->nama ?? '-' }}</td>
                <td align="center">{{ $item->user->jabatan ?? '-' }}</td>
                <td>{{ $item->in_time }}</td>
                <td>{{ $item->out_time ?? '-' }}</td>
                <td>{{ $item->total_duration ?? '-' }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

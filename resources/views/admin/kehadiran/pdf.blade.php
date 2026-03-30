<h1 align="center">Data Kehadiran</h1>

<p align="center">
    Dicetak pada Tanggal {{ $tanggal }} Pukul {{ $jam }}
</p>

<table width="100%" border="1" style="border-collapse: collapse; font-family: Arial, sans-serif; font-size: 14px;">
    <thead style="background-color: #f2f2f2;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Clock-In</th>
            <th>Clock-Out</th>
            <th>Total Duration</th>
            <th>Status</th>
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

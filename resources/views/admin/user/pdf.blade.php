<h1 align="center">Data User</h1>
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
        <th width="20" align="center">Name</th>
        <th width="20" align="center">Email</th>
        <th width="20" align="center">Jabatan</th>
        <th width="20" align="center">Status</th>
    </tr>
    </thead>
    <tbody>
        @foreach ( $user as $item )
            <tr>
                <td align="center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->email }}</td>
                <td align="center">{{ $item->jabatan }}</td>
                @if ($item->is_tugas == false)
                <td>Belum Ditugaskan</td>
                @else 
                <td>Ditugaskan</td>
                @endif
                
            </tr>
        
        @endforeach
    </tbody>
    </table>
</table>
@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-calendar-check"></i> {{ $title }}
</h1>
{{-- Tanggal & Jam --}}
<div class="mb-1 text-gray-700">
    <strong>Hari ini:</strong> {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y — H:i:s') }}
</div>

<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">

    <div>
        <a href="{{ route('userExcelKehadiran') }}" class="btn btn-sm btn-success">
            <i class="fas fa-file-excel mr-2"></i>
            Excel
        </a>
        <a href="{{ route('userPdfKehadiran') }}" class="btn btn-sm btn-danger" target='___blank'>
            <i class="fas fa-file-pdf mr-2"></i>
            PDF
        </a>
    </div>
    
        {{-- Tombol Clock In --}}
        @php
        $user = auth()->user();
        $kehadiranAktif = $kehadirans->where('user_id', $user->id)->firstWhere('out_time', null);
        @endphp

        @if ($user->jabatan == 'Manajer' && !$kehadiranAktif)
        <div>
            <form method="POST" action="{{ route('kehadiranClockIn') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fas fa-sign-in-alt mr-2"></i> Clock In
                </button>
            </form>
        </div>
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Clock In</th>
                        <th>Clock Out</th>
                        <th>Total Duration</th>
                        <th>Status</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kehadirans as $i => $row)
                    <tr class="text-center">
                        <td>{{ $kehadirans->firstItem() + $i }}</td>
                        <td>{{ $row->user->nama }}</td>
                        <td>{{ $row->in_time }}</td>
                        <td>{{ $row->out_time ?? '-' }}</td>
                        <td>
                            @if ($row->out_time)
                            {{ \Carbon\Carbon::parse($row->in_time)->diff($row->out_time)->format('%H:%I:%S') }}
                            @else
                            -
                            @endif
                        </td>
                        <td>
                            @if (is_null($row->out_time))
                            <span class="badge badge-warning">Berjalan</span>
                            @else
                            <span class="badge badge-success">Selesai</span>
                            @endif
                        </td>
                        <td>
                            @if (is_null($row->out_time))
                            <form method="POST" action="{{ route('kehadiranClockOut', ['aten_id' => $row->aten_id]) }}"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Clock Out sekarang?')">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('kehadiranDestroy', $row->aten_id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"
                                    data-id="{{ $row->aten_id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data kehadiran</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $kehadirans->links() }}
        </div>
    </div>
</div>
@endsection

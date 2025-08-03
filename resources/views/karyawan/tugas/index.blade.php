@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks"></i> {{ $title }}
</h1>

@if ($adaTugasBaru)
<div class="alert alert-info">
    <strong><i class="fas fa-bell"></i> Tugas Baru!</strong> Anda memiliki tugas baru yang belum dikerjakan.
</div>
@endif

<div class="mb-3">
    <a href="{{ route('excelTugas') }}" class="btn btn-sm btn-success">
        <i class="fas fa-file-excel mr-2"></i> Excel
    </a>
    <a href="{{ route('exportPdfKaryawan') }}" class="btn btn-sm btn-danger" target="_blank">
        <i class="fas fa-file-pdf mr-2"></i> PDF
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th><i class="fas fa-cogs"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->user->nama }}</td>
                        <td class="text-center">{{ $item->tugas }}</td>
                        <td><span class="badge badge-info">{{ $item->tanggal_mulai }}</span></td>
                        <td><span class="badge badge-info">{{ $item->tanggal_selesai }}</span></td>
                        <td class="text-center">
                            @if ($item->status == 0)
                                <span class="badge badge-danger">Belum Selesai</span>
                            @elseif ($item->status == 1)
                                <span class="badge badge-warning">Sedang Dikerjakan</span>
                            @elseif ($item->status == 2)
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-secondary">Proses Validasi</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalDetailTugas{{ $item->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <a href="{{ route('tugasKaryawanEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($item->file)
                            <a href="{{ asset('storage/tugas/' . $item->file) }}" target="_blank" class="btn btn-sm btn-success">
                                <i class="fas fa-download"></i>
                            </a>
                            @endif
                        </td>
                    </tr>

                    <!-- Modal Detail Tugas -->
                    @include('karyawan.tugas.modal', ['item' => $item])

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

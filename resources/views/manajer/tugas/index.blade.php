@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks"></i>
    {{ $title }}
</h1>
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-2">
            <a href="{{ route('tugasCreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Tambah Data
            </a>
        </div>
        <div>
            <a href="{{ route('excelTugas') }}" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-2"></i>
                Excel
            </a>
            <a href="{{ route('pdfTugas') }}" class="btn btn-sm btn-danger" target='___blank'>
                <i class="fas fa-file-pdf mr-2"></i>
                PDF
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text text-white">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status Tugas</th>
                        <th>File</th>
                        <th>
                            <i class="fas fa-cogs"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tugas as $item)
                    <tr>
                        <td class="text-center">{{ $loop ->iteration }}</td>

                        <td>{{ $item->user->nama }}</td>
                        <td class="text-center">{{ $item->tugas }}</td>
                        <td>
                            <span class="badge badge-info">{{ $item->tanggal_mulai }}</span></td>
                        <td>
                            <span class="badge badge-info">{{ $item->tanggal_selesai }}</span></td>
                        <td>
                            @if ($item->status == 0)
                            <span class="badge badge-danger">
                                Belum Selesai
                            </span>
                            @elseif ($item->status == 1)
                            <span class="badge badge-warning">
                                Sedang Dikerjakan
                            @elseif ($item->status == 2)
                            <span class="badge badge-success">
                                Selesai
                                @else
                                <span class="badge badge-primary">
                                    Proses Validasi
                                </span>
                                @endif
                            </span>
                        </td>
                        <td>
                            @if ($item->file)
                                <a href="{{ asset('storage/tugas/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-file-pdf"></i> Lihat File
                                </a>
                            @else
                                <span class="text-muted">Belum Upload</span>
                            @endif
                        </td>

                        <td class="text-center">
                        <button class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#modalDetailTugas{{ $item->id }}">
                            <i class="fas fa-eye"></i>
                        </button>
                            <a href="{{ route('tugasEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('tugasDestroy', $item->id) }}" class="d-inline form-hapus">
                            @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @include('manajer/tugas/modal', ['item' => $item])
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">

    </div>
</div>
</div>
</div>
</div>
</div>
{{-- CDN SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Script SweetAlert --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.form-hapus').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

</script>
@endsection

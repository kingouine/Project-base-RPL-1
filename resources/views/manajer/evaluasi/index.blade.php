@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-star"></i>
    {{ $title }}
</h1>
<div class="alert alert-info">
    <strong><i class="fas fa-exclamation-triangle"></i> Pengisian Evaluasi Kinerja Dilakukan Pada Tanggal 1 Setiap Bulan</strong>
</div>
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-2">
            <a href="{{ route('evaluasiCreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Tambah Data
            </a>
        </div>
        <div>
            <a href="{{ route('evaluasiExcel') }}" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-2"></i>
                Excel
            </a>
            <a href="{{ route('evaluasiPdf') }}" class="btn btn-sm btn-danger" target='___blank'>
                <i class="fas fa-file-pdf mr-2"></i>
                PDF
            </a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Periode</th>
                            <th>Total Jam</th>
                            <th>Tugas Selesai</th>
                            <th>Nilai Akhir</th>
                            <th>Penilaian</th>
                            <th>
                                <i class="fas fa-cogs"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($evaluasi as $e)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $e->user->nama }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($e->periode)->translatedFormat('F Y') }}
                            </td>
                            <td class="text-center">
                                <span class="badge badge-info">{{ $e->total_jam_kerja }} jam</span>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-secondary">{{ $e->jumlah_tugas_selesai }}</span>
                            </td>
                            <td class="text-center">{{ $e->nilai_akhir }}/20</td>
                            <td class="text-center">
                                <span class="badge 
                                @if ($e->penilaian == 'Excellent') badge-success
                                @else badge-warning
                                @endif">
                                    {{ $e->penilaian }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#modalDetail{{ $e->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>

                                <a href="{{ route('evaluasiEdit',$e->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit">
                                    </i>
                                </a>

                                <form method="POST" action="{{ route('evaluasiDestroy', $e->id) }}"
                                class="d-inline form-hapus">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                                </form>
                            </td>
                            @include('manajer/evaluasi/modal')
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data evaluasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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

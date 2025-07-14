@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-tasks"></i>
    {{ $title }}
</h1>

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
                                @else
                                <span class="badge badge-success">
                                    Selesai
                                </span>
                                @endif
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="{{ route('tugasKaryawanEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
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
@endsection

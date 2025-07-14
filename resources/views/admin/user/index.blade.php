@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-user"></i>
    {{ $title }}
</h1>
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-2">
            <a href="{{ route('userCreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Tambah Data
            </a>
        </div>
        <div>
            <a href="{{ route('userExcel') }}" class="btn btn-sm btn-success">
                <i class="fas fa-file-excel mr-2"></i>
                Excel
            </a>
            <a href="{{ route('userPdf') }}" class="btn btn-sm btn-danger" target='___blank'>
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
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>
                            <i class="fas fa-cogs"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                    <tr>
                        <td class="text-center">{{ $loop ->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td class="text-center">
                            <span class="badge badge-secondary">
                                {{ $item->email }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($item->jabatan == 'Admin')
                            <span class="badge badge-dark">
                                {{ $item->jabatan }}
                            </span>
                            @elseif ($item->jabatan == 'Karyawan')
                            <span class="badge badge-primary">
                                {{ $item->jabatan }}
                            </span>
                            @else ($item->jabatan == 'Manajer')
                            <span class="badge badge-info">
                                {{ $item->jabatan }}
                            </span>
                            @endif
                        </td>
                        <td>
                            @if ($item->is_tugas == false)
                            <span class="badge badge-danger">
                                Belum Ditugaskan
                            </span>
                            @else
                            <span class="badge badge-success">
                                Sudah Ditugaskan
                                @endif
                            </span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-info" data-toggle="modal"
                                data-target="#modalDetailUser{{ $item->id }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            @include('admin.user.modal', ['user' => $user])
                            <a href="{{ route('userEdit',$item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit">
                                </i>
                            </a>
                            <form method="POST" action="{{ route('userDestroy', $item->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

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

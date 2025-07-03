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
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text text-white">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tugas</th>
                                            <th>Tanggal_Mulai</th>
                                            <th>Tanggal_Selesai</th>
                                            <th>Status</th>
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
                                            <span class ="badge badge-info">{{ $item->tanggal_selesai }}</span></td>
                                            <td>{{ $item->status }}</td>
                                            
                                            <td class="text-center"> 
                                                <a href="{{ route('userEdit',$item->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit">
                                                    </i>
                                                </a>
                                                <button class="btn btn-sm btn-danger"
                                                data-toggle="modal" data-target="#exampleModal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                @include ('admin/user/modal')
                
                
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
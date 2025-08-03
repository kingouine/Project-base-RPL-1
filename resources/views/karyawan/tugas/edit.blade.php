@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit"></i>
    Ubah Tugas Karyawan
</h1>
<div class="card">
    <div class="card-header bg-warning">
        <a href="{{ route('tugasKaryawan') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
        <div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('tugasKaryawanUpdate', $tugas->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-2">

                <div class="col-8">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Nama :
                    </label>
                    <input type="text" value="{{ $tugas->user->nama }}" class="form-control" disabled>

                </div>


                <div class="col-8">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Tugas :
                    </label>
                    <textarea name="tugas" rows="5" class="form-control @error('tugas') is-invalid
                                    @enderror" disabled>{{ $tugas->tugas }}</textarea>
                    @error('tugas')

                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="col-8">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Tanggal Mulai :
                    </label>
                    <input type="date" name="tanggal_mulai" class="form-control @error('tanggal_mulai') is-invalid
                                    @enderror" disabled value="{{ $tugas->tanggal_mulai }}">

                    @error('tanggal_mulai')

                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="col-8">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Tanggal Selesai :
                    </label>
                    <input type="date" name="tanggal_selesai" class="form-control @error('tanggal_selesai') is-invalid
                                    @enderror" disabled value="{{ $tugas->tanggal_selesai }}">

                    @error('tanggal_selesai')

                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>

                <div class="col-8">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Status Tugas :
                    </label>
                    <select name="status" class="form-control @error('status') is-invalid
                                    @enderror">
                        <option value="0" {{ $tugas->status== '0' ? 'selected' : '' }}>Belum Selesai</option>
                        <option value="1" {{ $tugas->status== '1' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="2" {{ $tugas->status== '2' ? 'selected' : '' }}>Selesai</option>
                        <option value="3" {{ $tugas->status== '3' ? 'disabled' : '' }}>Proses Validasi</option>
                    </select>
                    @error('status')

                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <div class="col-8">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Upload File Baru:
                    </label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                    @error('file')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if ($tugas->file)
                <div class="col-8 mb-2">
                    <label class="form-label">
                    </label>
                    <div class="mb-2">
                        @if ($tugas->file)
                        <p><strong>File Saat Ini:</strong> <a href="{{ asset('storage/tugas/' . $tugas->file) }}"
                                target="_blank">{{ $tugas->file }}</a></p>
                        @endif
                    </div>
                    </label>
                </div>
                @endif

               
            </div>
            <div>
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-edit">
                    </i>
                    Edit
                </button>
            </div>
        </form>
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

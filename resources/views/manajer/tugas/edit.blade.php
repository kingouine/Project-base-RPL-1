@extends('layout.app')

@section('content')
   <h1 class="h3 mb-4 text-gray-800">
   <i class="fas fa-plus"></i>
   {{ $title }}
</h1>
<div class="card">
<div class="card-header bg-warning">
        <a href="{{ route('tugas') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    <div>
    </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('tugasUpdate', $tugas->id) }}" method="post">
                                @csrf
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
                                    @enderror">{{ $tugas->tugas }}</textarea>
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
                                    @enderror"
                                    value="{{ $tugas->tanggal_mulai }}">

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
                                    @enderror"
                                    value="{{ $tugas->tanggal_selesai }}">

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
                                    <select name="status"
                                    class="form-control @error('status') is-invalid
                                    @enderror">
                                        <option value="0"{{ $tugas->status== '0' ? 'selected' : '' }}>Belum Selesai</option>
                                        <option value="1"{{ $tugas->status== '1' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                        <option value="2"{{ $tugas->status== '2' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status')
                                    
                                    <small class="text-danger">
                                    {{ $message }}
                                    </small>
                                    @enderror 
                                </div>


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
@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-plus"></i>
    {{ $title }}
</h1>
<div class="card">
    <div class="card-header bg-primary">
        <a href="{{ route('evaluasi') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
        <div>
        </div>
        </div>
        <div class = "card-body">
        <form action="{{ route('evaluasiUpdate', $evaluasi->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" class="form-control" value="{{ $evaluasi->user->nama }}" disabled>
            </div>

            <div class="mb-3">
                <label>Periode</label>
                <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($evaluasi->periode)->translatedFormat('F Y') }}" disabled>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', $evaluasi->keterangan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection

@extends('layout.app')

@section('content')
<h4>{{ $title }}</h4>

<div class="card">
    <div class="card-body">
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

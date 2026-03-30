@extends('layout.app')
@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-plus"></i>
    {{ $title }}
</h1>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

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
        <form action="{{ route('evaluasiStore') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Karyawan</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->nama }} ({{ $u->jabatan }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Periode Evaluasi (Bulan)</label>
                <input type="date" name="periode" class="form-control @error('periode') is-invalid
                @enderror">
                @error('periode')

                <small class="text-danger">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid
                @enderror"></textarea>
                @error('keterangan')

                <small class="text-danger">
                    {{ $message }}
                </small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Evaluasi</button>
        </form>
        </div>

        @endsection

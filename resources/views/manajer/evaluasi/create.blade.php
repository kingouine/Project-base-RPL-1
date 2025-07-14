@extends('layout.app')
@section('content')

<h4>{{ $title }}</h4>

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
        <input type="date" name="periode" class="form-control">
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Evaluasi</button>
</form>

@endsection

@extends('layout.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-plus"></i> {{ $title }}
</h1>

<div class="card">
    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
        <a href="{{ route('tugas') }}" class="btn btn-sm btn-danger">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('tugasStore') }}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label"><span class="text-danger">*</span> Nama :</label>
                <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                    <option selected disabled>-- Pilih Nama --</option>
                    @foreach ($user as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('user_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><span class="text-danger">*</span> Tugas :</label>
                <textarea name="tugas" rows="5" class="form-control @error('tugas') is-invalid @enderror"></textarea>
                @error('tugas')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><span class="text-danger">*</span> Tanggal Mulai :</label>
                <input type="date" name="tanggal_mulai"
                    class="form-control @error('tanggal_mulai') is-invalid @enderror" min="{{ date('Y-m-d') }}">
                @error('tanggal_mulai')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label"><span class="text-danger">*</span> Tanggal Selesai :</label>
                <input type="date" name="tanggal_selesai"
                    class="form-control @error('tanggal_selesai') is-invalid @enderror">
                @error('tanggal_selesai')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</div>

<script>
    const tanggalMulaiInput = document.querySelector('input[name="tanggal_mulai"]');
    const tanggalSelesaiInput = document.querySelector('input[name="tanggal_selesai"]');

    tanggalMulaiInput.addEventListener('change', function () {
        tanggalSelesaiInput.setAttribute('min', this.value);
    });

</script>
@endsection

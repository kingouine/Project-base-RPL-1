<!-- Modal Detail Tugas dan Upload -->
<div class="modal fade" id="modalDetailTugas{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalDetailTugasLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalDetailTugasLabel{{ $item->id }}">
                    Detail Tugas: {{ $item->tugas }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Karyawan:</strong> {{ $item->user->nama }}</p>
                <p><strong>Tugas:</strong> {{ $item->tugas }}</p>
                <p><strong>Tanggal Mulai:</strong> {{ $item->tanggal_mulai }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $item->tanggal_selesai }}</p>
                <p><strong>Status:</strong>
                    @if ($item->status == 0)
                    <span class="badge badge-danger">Belum Selesai</span>
                    @elseif ($item->status == 1)
                    <span class="badge badge-warning">Sedang Dikerjakan</span>
                    @elseif ($item->status == 2)
                    <span class="badge badge-success">Sedang Ditinjau</span>
                    @else
                    <span class="badge badge-secondary">Proses Validasi</span>
                    @endif
                </p>
                @if($item->timbal_balik)
                    <div class="alert alert-info">
                        <strong>Timbal Balik Manajer:</strong><br>
                        {{ $item->timbal_balik }}
                    </div>
                    @endif

                <hr>
                <form action="{{ route('tugas.uploadFile', $item->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file">Upload File Tugas (.pdf)</label>
                        <input type="file" name="file" class="form-control" accept=".pdf" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload & Ajukan Tinjauan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

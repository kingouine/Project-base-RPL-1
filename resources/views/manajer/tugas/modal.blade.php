<!-- Modal Detail Tugas -->
<div class="modal fade" id="modalDetailTugas{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailTugasLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDetailTugasLabel{{ $item->id }}">Detail Tugas - {{ $item->user->nama }}</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Nama Karyawan:</strong> {{ $item->user->nama }}</li>
          <li class="list-group-item"><strong>Tugas:</strong> {{ $item->tugas }}</li>
          <li class="list-group-item"><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}</li>
          <li class="list-group-item"><strong>Tanggal Selesai:</strong> {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}</li>
          <li class="list-group-item">
            <strong>Status:</strong>
            @if ($item->status == 0)
              <span class="badge badge-danger">Belum Dikerjakan</span>
            @elseif ($item->status == 1)
              <span class="badge badge-warning">Sedang Dikerjakan</span>
            @else
              <span class="badge badge-success">Selesai</span>
            @endif
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

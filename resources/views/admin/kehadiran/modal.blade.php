<!-- Modal Detail Kehadiran -->
<div class="modal fade" id="modalDetailKehadiran{{ $item->aten_id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailKehadiranLabel{{ $item->aten_id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDetailKehadiranLabel{{ $item->aten_id }}">Detail Kehadiran - {{ $item->user->nama }}</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-left">
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>Nama Karyawan:</strong> {{ $item->user->nama }}</li>
          <li class="list-group-item"><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($item->in_time)->format('d-m-Y H:i:s') }}</li>
          <li class="list-group-item"><strong>Tanggal Keluar:</strong> 
            {{ $item->out_time ? \Carbon\Carbon::parse($item->out_time)->format('d-m-Y H:i:s') : '-' }}
          </li>
          <li class="list-group-item"><strong>Total Durasi:</strong> {{ $item->total_duration ?? '-' }}</li>
          <li class="list-group-item"><strong>Status:</strong> 
            @if ($item->status == 1)
              <span class="badge badge-warning">Berjalan</span>
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

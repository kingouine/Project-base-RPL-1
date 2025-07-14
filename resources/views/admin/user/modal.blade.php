<!-- Modal Detail User -->
<div class="modal fade" id="modalDetailUser{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailUserLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDetailUserLabel{{ $item->id }}">Detail User - {{ $item->nama }}</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <strong>Nama:</strong> {{ $item->nama }}
          </li>
          <li class="list-group-item">
            <strong>Email:</strong> {{ $item->email }}
          </li>
          <li class="list-group-item">
            <strong>Jabatan:</strong> {{ $item->jabatan }}
          </li>
          <li class="list-group-item">
            <strong>Status:</strong>
            <span class="badge {{ $item->is_tugas ? 'badge-success' : 'badge-danger' }}">
              {{ $item->is_tugas ? 'Ditugaskan' : 'Belum Ditugaskan' }}
            </span>
          </li>
          <li class="list-group-item">
            <strong>Dibuat Pada:</strong> {{ $item->created_at->translatedFormat('d F Y, H:i') }}
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

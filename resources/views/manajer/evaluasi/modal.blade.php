@foreach ($evaluasi as $e)
<div class="modal fade" id="modalDetail{{ $e->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel{{ $e->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalDetailLabel{{ $e->id }}">Detail Evaluasi - {{ $e->user->nama }}</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <strong>Periode:</strong> {{ \Carbon\Carbon::parse($e->periode)->translatedFormat('F Y') }}
          </li>
          <li class="list-group-item">
            <strong>Total Jam Kerja:</strong> {{ $e->total_jam_kerja }} jam
          </li>
          <li class="list-group-item">
            <strong>Jumlah Tugas Selesai:</strong> {{ $e->jumlah_tugas_selesai }}
          </li>
          <li class="list-group-item">
            <strong>Nilai Kehadiran:</strong> {{ $e->nilai_kehadiran }}/10
          </li>
          <li class="list-group-item">
            <strong>Nilai Tugas:</strong> {{ $e->nilai_tugas }}/10
          </li>
          <li class="list-group-item">
            <strong>Nilai Akhir:</strong> {{ $e->nilai_akhir }}/20
          </li>
          <li class="list-group-item">
            <strong>Penilaian:</strong>
            <span class="badge {{ $e->penilaian == 'Excellent' ? 'badge-success' : 'badge-warning' }}">
              {{ $e->penilaian }}
            </span>
          </li>
          <li class="list-group-item">
            <strong>Keterangan:</strong> {{ $e->keterangan ?? '-' }}
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endforeach

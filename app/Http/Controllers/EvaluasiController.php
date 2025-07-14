<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluasi;
use App\Models\Kehadiran;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class EvaluasiController extends Controller
{
    public function index()
    {
        $data = [ 
            'menuManajerEvaluasi' => "active",
            'title' => 'Data Evaluasi Kinerja',
            'evaluasi' => Auth::user()->jabatan == 'Manajer'
                ? Evaluasi::with('user')->get()
                : Evaluasi::with('user')->where('user_id', Auth::id())->get(),
        ];
        return view('manajer/evaluasi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Buat Evaluasi Kinerja',
            'users' => User::whereIn('jabatan', ['Karyawan'])->get(),
        ];
        return view('manajer/evaluasi/create', $data);
    }

    public function store(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'periode' => 'required|date',
    ]);

    $userId = $request->user_id;
    $periode = Carbon::parse($request->periode);

    // Ambil data kehadiran dalam bulan tertentu
    $kehadirans = Kehadiran::where('user_id', $userId)
        ->whereMonth('in_time', $periode->month)
        ->whereYear('in_time', $periode->year)
        ->get();

    // Hitung total duration dalam detik
    $totalDetik = 0;

    foreach ($kehadirans as $k) {
        if ($k->total_duration) {
            [$jam, $menit, $detik] = explode(':', $k->total_duration);
            $totalDetik += ($jam * 3600) + ($menit * 60) + $detik;
        } elseif ($k->in_time && $k->out_time) {
            // Jika total_duration belum ada, hitung manual
            $totalDetik += Carbon::parse($k->in_time)->diffInSeconds(Carbon::parse($k->out_time));
        }
    }

    $totalJam = round($totalDetik / 3600, 2); // Konversi ke jam

    // Hitung jumlah tugas selesai
    $jumlahTugasSelesai = Tugas::where('user_id', $userId)
        ->where('status', 2) // selesai
        ->whereMonth('created_at', $periode->month)
        ->whereYear('created_at', $periode->year)
        ->count();

    // Nilai berdasarkan range
    $nilaiKehadiran = $totalJam >= 40 ? 10 : ($totalJam >= 30 ? 7 : 4);
    $nilaiTugas = $jumlahTugasSelesai >= 3 ? 10 : ($jumlahTugasSelesai >= 1 ? 7 : 4);
    $nilaiAkhir = $nilaiKehadiran + $nilaiTugas;
    $penilaian = $nilaiAkhir >= 16 ? 'Excellent' : 'Butuh Evaluasi';

    Evaluasi::create([
        'user_id' => $userId,
        'periode' => $periode->toDateString(),
        'total_jam_kerja' => $totalJam,
        'jumlah_tugas_selesai' => $jumlahTugasSelesai,
        'nilai_kehadiran' => $nilaiKehadiran,
        'nilai_tugas' => $nilaiTugas,
        'nilai_akhir' => $nilaiAkhir,
        'penilaian' => $penilaian,
        'keterangan' => $request->keterangan,
    ]);

    return redirect()->route('evaluasi')->with('success', 'Evaluasi berhasil disimpan.');
}

public function edit($id)
{
    $data = [
        'title' => 'Edit Evaluasi Kinerja',
        'evaluasi' => Evaluasi::with('user')->findOrFail($id),
    ];
    return view('manajer/evaluasi/edit', $data);
}

public function update(Request $request, $id)
{
    $request->validate([
        'keterangan' => 'nullable|string|max:255',
    ]);

    $evaluasi = Evaluasi::findOrFail($id);
    $evaluasi->keterangan = $request->keterangan;
    $evaluasi->save();

    return redirect()->route('evaluasi')->with('success', 'Evaluasi berhasil diperbarui.');
}
}

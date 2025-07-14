<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Tugas;
use App\Exports\tugasExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TugasController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data Tugas',
            'menuManajerTugas' => "active",
            'tugas' => Tugas::with('user')->get(),
        );
        return view('manajer/tugas/index', $data);
    }

    public function tugasKaryawan() {
        $user = Auth::user();

        $adaTugasBaru = Tugas::where('user_id', $user->id)
        ->where('status', 0)
        ->whereDate('created_at', Carbon::today())
        ->exists();
        $data = array(
            'title' => 'Data Tugas Karyawan',
            'menuKaryawanTugas' => "active",
            'tugas' => Tugas::with('user')->where('user_id', $user->id)->get(),
            'adaTugasBaru' => $adaTugasBaru,
        );
        return view ('karyawan/tugas/index', $data);
    }

    public function create() {
        $data = array(
            'title' => 'Tambah Data Tugas',
            'menuManajerTugas' => "active",
            'user' => User::where('jabatan', 'Karyawan')->where ('is_tugas', false)->get(),
        );
        return view('manajer/tugas/create', $data);
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'tugas' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',


        ],[
            'user_id.required' => 'Nama Tidak Boleh Kosong',
            'tugas.required' => 'Tugas Tidak Boleh Kosong',
            'tanggal_mulai.required' => 'Tanggal Mulai Tidak Boleh Kosong',
            'tanggal_selesai.required' => 'Tanggal Selesai Tidak Boleh Kosong',

        ]);
        $user = User::findOrFail($request->user_id);
        $tugas = new Tugas;
        $tugas->user_id = $request->user_id;
        $tugas->tugas = $request->tugas;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->save();
        $tugas->status = false;
        $user-> is_tugas = true;
        $user-> save();

        return redirect()->route('tugas')->with('success', 'Data Berhasil Ditambahkan');

    }
    public function edit($id){
        $data = array(
            'title' => 'Ubah Data Tugas',
            'menuAdminUser' => "active",
            'tugas'  => Tugas::with('user')->findOrFail($id),
        );
        return view('manajer/tugas/edit', $data);
    }

    public function editTugasKaryawan($id)
{
    $tugas = Tugas::with('user')->findOrFail($id);

    if ($tugas->user_id !== Auth::id()) {
        abort(403, 'Anda tidak memiliki akses untuk tugas ini.');
    }

    $data = [
        'title' => 'Ubah Status Tugas',
        'menuKaryawanTugas' => 'active',
        'tugas' => $tugas,
    ];

    return view('karyawan/tugas/edit', $data);
}

    public function update(Request $request, $id){
        $request->validate([
            'tugas' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',


        ],[
            'tugas.required' => 'Tugas Tidak Boleh Kosong',
            'tanggal_mulai.required' => 'Tanggal Mulai Tidak Boleh Kosong',
            'tanggal_selesai.required' => 'Tanggal Selesai Tidak Boleh Kosong',

        ]);
        $tugas = Tugas::findOrFail($id);
        $tugas->tugas = $request->tugas;
        $tugas->tanggal_mulai = $request->tanggal_mulai;
        $tugas->tanggal_selesai = $request->tanggal_selesai;
        $tugas->status = $request->status;
        $tugas->save();
        if ($request->status == 2) {
            $user = $tugas->user;
            $user->is_tugas = false;
            $user->save();
        }

        return redirect()->route('tugas')->with('success', 'Data Berhasil Diedit');

    }

    public function updateTugasKaryawan(Request $request, $id)
{
    $tugas = Tugas::findOrFail($id);
    if ($tugas->user_id !== Auth::id()) {
        abort(403, 'Anda tidak berhak mengubah tugas ini.');
    }

    $request->validate([
        'status' => 'required|in:0,1,2',
    ], [
        'status.required' => 'Status tidak boleh kosong.',
    ]);

    $tugas->status = $request->status;
    $tugas->save();

    if ($request->status == 2) {
        $user = $tugas->user;
        $user->is_tugas = false;
        $user->save();
    }

    return redirect()->route('tugasKaryawan')->with('success', 'Status tugas berhasil diperbarui.');
}
    public function destroy($id)
{
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();
        $user = User::where('id',$tugas->user_id)->first();
        $user ->is_tugas = false;
        $user -> save();

    return back()->with('success', 'Data berhasil dihapus.');
}
public function excelTugas(){
    $filename = now()->format ('d-m-Y_H.i.s');

    $user = Auth::user();
    $user_id = $user->id;
    $role = $user->jabatan;
    return Excel::download(new tugasExport($user_id, $role), 'Data Tugas'.$filename.'.xlsx');
}
public function pdfTugas() {
    $filename = now()->format ('d-m-Y_H.i.s');
    $data = array(
        'tugas' => Tugas::get(),
        'tanggal' => now()->format ('d-m-Y'),
        'jam' =>now()->format('H.i.s'),
    );

    $pdf = Pdf::loadView('manajer/tugas/pdf', $data);
    return $pdf->stream('Data Tugas_'.$filename.'.pdf');
}

}

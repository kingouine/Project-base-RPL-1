<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kehadiran;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\KehadiranExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class KehadiranController extends Controller
{
    public function kehadiran()
    {
        Carbon::setLocale('id');
        $now = Carbon::now('Asia/Jakarta');

        $user = auth()->user();

        // Jika admin, tampilkan semua
        if ($user->jabatan == 'Admin') {
            $kehadirans = Kehadiran::with('user')
                ->orderByDesc('in_time')
                ->paginate(10);
        } else {
            // Jika bukan admin, tampilkan hanya miliknya sendiri
            $kehadirans = Kehadiran::with('user')
                ->where('user_id', $user->id)
                ->orderByDesc('in_time')
                ->paginate(10);
        }

        return view('admin.kehadiran.kehadiran', [
            'title' => 'Data Kehadiran',
            'menuAdminKehadiran' => 'active',
            'kehadirans' => $kehadirans,
            'now' => $now
        ]);
    }

    public function kehadiranManajer()
    {
        Carbon::setLocale('id');
        $now = Carbon::now('Asia/Jakarta');

        $user = auth()->user();

        // Jika admin, tampilkan semua
        if ($user->jabatan == 'Admin') {
            $kehadirans = Kehadiran::with('user')
                ->orderByDesc('in_time')
                ->paginate(10);
        } else {
            // Jika bukan admin, tampilkan hanya miliknya sendiri
            $kehadirans = Kehadiran::with('user')
                ->where('user_id', $user->id)
                ->orderByDesc('in_time')
                ->paginate(10);
        }

        return view('manajer.kehadiran.index', [
            'title' => 'Data Kehadiran',
            'menuManajerKehadiran' => 'active',
            'kehadirans' => $kehadirans,
            'now' => $now
        ]);
    }
    

    public function kehadiranKaryawan()
    {
        Carbon::setLocale('id');
        $now = Carbon::now('Asia/Jakarta');

        $user = auth()->user();

        // Jika admin, tampilkan semua
        if ($user->jabatan == 'Admin') {
            $kehadirans = Kehadiran::with('user')
                ->orderByDesc('in_time')
                ->paginate(10);
        } else {
            // Jika bukan admin, tampilkan hanya miliknya sendiri
            $kehadirans = Kehadiran::with('user')
                ->where('user_id', $user->id)
                ->orderByDesc('in_time')
                ->paginate(10);
        }

        return view('karyawan.kehadiran.index', [
            'title' => 'Data Kehadiran',
            'menuKaryawanKehadiran' => 'active',
            'kehadirans' => $kehadirans,
            'now' => $now
        ]);
    }



    public function clockIn()
    {
        $user = auth()->user();

        $sudahClockIn = Kehadiran::where('user_id', $user->id)
            ->whereNull('out_time')
            ->exists();

        if ($sudahClockIn) {
            return back()->with('error', 'Anda sudah Clock-In. Harap Clock-Out dahulu.');
        }

        Kehadiran::create([
            'user_id' => $user->id,
            'in_time' => Carbon::now('Asia/Jakarta'),
            'status' => 'clock in'
        ]);

        return back()->with('success', 'Berhasil Clock In.');
    }

    public function clockOut($aten_id)
    {
        $kehadiran = Kehadiran::findOrFail($aten_id);

        if ($kehadiran->out_time !== null) {
            return back()->with('error', 'Sudah Clock Out sebelumnya.');
        }

        $now = Carbon::now('Asia/Jakarta');

        $kehadiran->out_time = $now;
        $kehadiran->total_duration = $kehadiran->in_time->diff($now)->format('%H:%I:%S');
        $kehadiran->status = 'clock out';
        $kehadiran->save();

        return back()->with('success', 'Berhasil Clock Out.');
    }

    public function destroy($aten_id)
{
        $kehadiran = Kehadiran::findOrFail($aten_id);
        $kehadiran->delete();

    return back()->with('success', 'Data berhasil dihapus.');
}
    public function excelKehadiran(){
        $filename = now()->format ('d-m-Y_H.i.s');

        $user = Auth::user();
        $user_id = $user->id;
        $role = $user->jabatan;
        return Excel::download(new KehadiranExport($user_id, $role), 'DataKehadiran_'.$filename.'.xlsx');
}

public function pdfKehadiran()
{
    $user = Auth::user();
    $role = $user->jabatan;
    $user_id = $user->id;

    // Admin bisa lihat semua data
    if ($role === 'Admin') {
        $kehadirans = Kehadiran::with('user')->get();
    } else {
        // Manajer dan Karyawan hanya lihat data mereka sendiri
        $kehadirans = Kehadiran::with('user')
            ->where('user_id', $user_id)
            ->get();
    }

    // Hitung total_duration untuk masing-masing data
    foreach ($kehadirans as $item) {
        if ($item->in_time && $item->out_time) {
            $item->total_duration = Carbon::parse($item->in_time)
                ->diff(Carbon::parse($item->out_time))
                ->format('%H:%I:%S');
        } elseif ($item->in_time && is_null($item->out_time)) {
            $item->total_duration = Carbon::parse($item->in_time)
                ->diff(now())
                ->format('%H:%I:%S');
        } else {
            $item->total_duration = '-';
        }
    }

    $tanggal = now()->format('d-m-Y');
    $jam = now()->format('H:i:s');

    $pdf = Pdf::loadView('admin.kehadiran.pdf', compact('kehadirans', 'tanggal', 'jam'));

    return $pdf->stream('data-kehadiran-' . $tanggal . '.pdf');
}



}

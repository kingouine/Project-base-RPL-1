<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $data = array(
            "title" => "Dashboard",
            "menuDashboard" => "active",
            'total_user' => User::count(),
            'total_admin' => User::where('jabatan', 'Admin')->count(),
            'total_karyawan' => User::where('jabatan', 'Karyawan')->count(),
            'total_manajer' => User::where('jabatan', 'Manajer')->count(),
            'total_sudah_ditugaskan' => User::where('is_tugas', true)->count(),
            'total_belum_ditugaskan' => User::where('is_tugas', false)->count(),
        );
        return view ('dashboard', $data);
    }

    public function dashboardKaryawan()
{
    $user = Auth::user();

    $statusTugas = $user->is_tugas 
        ? 'Anda sudah ditugaskan. Silakan cek tugas Anda di menu Tugas.' 
        : 'Anda belum ditugaskan. Silakan tunggu penugasan dari manajer.';

    $data = [
        'title' => 'Dashboard Karyawan',
        'status_tugas' => $statusTugas,
        "menuDashboardKaryawan" => "active",
    ];

    return view('karyawan/dashboard/index', $data);
}
}

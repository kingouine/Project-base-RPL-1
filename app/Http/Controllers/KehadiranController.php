<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function Kehadiran(){
        $data = array(
            'title' => 'Jam Kerja',
            'menuAdminKehadiran' => 'active',
        );
        return view('admin/user/Kehadiran', $data);
    }
}

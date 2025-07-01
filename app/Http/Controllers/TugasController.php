<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Data Tugas',
            'menuManajerTugas' => 'active',
        );
        return view('manajer/tugas/index', $data);
    }
}

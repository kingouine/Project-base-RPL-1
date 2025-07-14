<?php

namespace App\Exports;

use App\Models\Tugas;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TugasExport implements FromView
{
    protected $user_id;
    protected $role;

    public function __construct($user_id, $role)
    {
        $this->user_id = $user_id;
        $this->role = $role;
    }

    public function view(): View
    {
        if ($this->role === 'Manajer') {
            $tugas = Tugas::with('user')->orderBy('id', 'asc')->get();
        } 
        elseif ($this->role === 'Karyawan') {
            $tugas = Tugas::with('user')
                ->where('user_id', $this->user_id)
                ->orderBy('id', 'asc')
                ->get();
        } 
        else {
            $tugas = collect();
        }

        return view('manajer/tugas/excel', [
            'tugas' => $tugas,
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ]);
    }
}

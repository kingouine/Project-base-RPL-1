<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Tugas;
use App\Models\Kehadiran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class tugasExport implements FromView
{
    public function view(): View {
        $data = array(
            'tugas' => Tugas::orderBy( 'id', 'asc')->get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),

        );
        return view ('manajer/tugas/excel', $data);
    }
}

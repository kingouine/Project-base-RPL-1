<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Kehadiran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class KehadiranExport implements FromView
{
    public function view(): View {
        $data = array(
            'kehadirans' => Kehadiran::orderBy( 'aten_id', 'asc')->get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),

        );
        return view ('admin/kehadiran/excel', $data);
    }
}

<?php

namespace App\Exports;

use App\Models\Kehadiran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KehadiranExport implements FromView
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
        if ($this->role === 'Admin') {
            $kehadirans = Kehadiran::orderBy('aten_id', 'asc')->get();
        } else {
            $kehadirans = Kehadiran::where('user_id', $this->user_id)
                            ->orderBy('aten_id', 'asc')
                            ->get();
        }

        return view('admin/kehadiran/excel', [
            'kehadirans' => $kehadirans,
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ]);
    }
}

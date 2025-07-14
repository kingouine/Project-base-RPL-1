<?php

namespace App\Exports;

use App\Models\Evaluasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EvaluasiExport implements FromView
{
    protected $userId;
    protected $role;

    public function __construct($userId, $role)
    {
        $this->userId = $userId;
        $this->role = $role;
    }

    public function view(): View
    {
        $evaluasi = $this->role === 'Manajer'
            ? Evaluasi::with('user')->get()
            : Evaluasi::with('user')->where('user_id', $this->userId)->get();

        return view('manajer.evaluasi.excel', [
            'evaluasi' => $evaluasi,
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ]);
    }
}

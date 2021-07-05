<?php

namespace App\Exports;

use App\Models\Doctor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DoctorExport implements FromView
{
    public function view(): View
    {
        return view('admin.doctors._export', [
            'doctors' => Doctor::all()
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'I' =>  "0",
        ];
    }
}

?>
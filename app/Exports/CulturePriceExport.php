<?php

namespace App\Exports;

use App\Models\Culture;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CulturePriceExport implements FromView
{
    public function view(): View
    {
        return view('admin.prices._cultures_export', [
            'cultures' => Culture::all(),
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
<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Test;

class TestPriceExport implements FromView
{
    public function view(): View
    {
        return view('admin.prices._tests_export', [
            'tests' => Test::where('parent_id',0)->orWhere('separated',true)->get(),
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
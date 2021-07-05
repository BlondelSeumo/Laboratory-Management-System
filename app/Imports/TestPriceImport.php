<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Test;

class TestPriceImport implements ToModel,WithStartRow,WithValidation
{
    /**
     * @param array $row
     *
     * @return Patient|null
     */
    public function model(array $row)
    {
        $test=Test::where('id',$row[0])->first();

        if(isset($row[0])&&isset($test))
        {
            $test->update([
                'price'=>$row[2]
            ]);
        }
    }


    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }


    public function rules(): array
    {
        return [
            '2'=>[
                'required',
                'numeric'
            ],
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => __('Test id'),
            '1' => __('Name'),
            '2' => __('Price'),
        ];
    }
}
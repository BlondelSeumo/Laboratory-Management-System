<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Culture;

class CulturePriceImport implements ToModel,WithStartRow,WithValidation
{
    /**
     * @param array $row
     *
     * @return Patient|null
     */
    public function model(array $row)
    {
        $culture=Culture::where('id',$row[0])->first();

        if(isset($culture))
        {
            $culture->update([
                'name'=>$row[1],
                'price'=>$row[2],
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
            '2'=>'required|numeric',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '0' => __('Culture id'),
            '1' => __('Culture name'),
            '2' => __('Price'),
        ];
    }
}
<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Patient;

class PatientImport implements ToModel,WithStartRow,WithValidation,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Patient|null
     */
    public function model(array $row)
    {
        if(isset($row['id']))
        {
            $patient=Patient::find($row['id']);

            if(isset($patient))
            {
                $patient->update([
                    'name'=>$row['name'],
                    'gender'=>$row['gender'],
                    'dob'=>$row['dob'],
                    'phone'=>$row['phone'],
                    'email'=>$row['email'],
                    'address'=>$row['address'],
                ]);

            }
            else{
                return Patient::create([
                    'code'=>patient_code(),
                    'name'=>$row['name'],
                    'gender'=>$row['gender'],
                    'dob'=>$row['dob'],
                    'phone'=>$row['phone'],
                    'email'=>$row['email'],
                    'address'=>$row['address'],
                ]);
            }
        }
        else{
            return Patient::create([
                'code'=>time(),
                'name'=>$row['name'],
                'gender'=>$row['gender'],
                'dob'=>$row['dob'],
                'phone'=>$row['phone'],
                'email'=>$row['email'],
                'address'=>$row['address'],
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
            'name'=>'required',
            'gender'=>[
                'required',
                Rule::in(['male','female']),
            ],
            'dob'=>'required|date',
            'phone'=>[
                'required',
            ],
            'email'=>[
                'required',
            ],
            'address'=>[
                'required',
            ],
        ];
    }

   
}
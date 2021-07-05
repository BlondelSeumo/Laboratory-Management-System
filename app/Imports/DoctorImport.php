<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Doctor;

class DoctorImport implements ToModel,WithStartRow,WithValidation,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Doctor|null
     */
    public function model(array $row)
    {
        if(isset($row['id']))
        {
            $doctor=Doctor::find($row['id']);

            if(isset($doctor))
            {
                $doctor->update([
                    'name'=>$row['name'],
                    'phone'=>$row['phone'],
                    'email'=>$row['email'],
                    'address'=>$row['address'],
                    'commission'=>$row['commission'],
                ]);
            }
            else{
                return Doctor::create([
                    'code'=>time(),
                    'name'=>$row['name'],
                    'phone'=>$row['phone'],
                    'email'=>$row['email'],
                    'address'=>$row['address'],
                    'commission'=>$row['commission'],
                ]);
            }
        }
        else{
            return Doctor::create([
                'code'=>time(),
                'name'=>$row['name'],
                'phone'=>$row['phone'],
                'email'=>$row['email'],
                'address'=>$row['address'],
                'commission'=>$row['commission'],
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
            'phone'=>[
                'required',
            ],
            'email'=>[
                'required',
                'email',
            ],
            'address'=>[
                'required',
            ],
            'commission'=>[
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
        ];
    }

   
}
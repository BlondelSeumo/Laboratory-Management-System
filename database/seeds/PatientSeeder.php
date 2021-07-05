<?php

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::truncate();

        Patient::create([
            'code'=>'1593914720',
            'name'=>'patient',
            'gender'=>'male',
            'dob'=>'28-08-1995',
            'phone'=>'+201063955280',
            'email'=>'osamamohamed2050@gmail.com',
            'address'=>'Egypt',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Models\Culture;

class CulturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Culture::truncate();
        
        Culture::create([
            'name'=>'Blood Culture',
            'price'=>'100'
        ]);
    }
}

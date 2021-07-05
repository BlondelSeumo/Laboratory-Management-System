<?php

use Illuminate\Database\Seeder;
use App\Models\CultureOption;

class CultureOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CultureOption::truncate();
        
        CultureOption::insert([
            [
                'value'=>'Organism',
                'parent_id'=>0
            ],
            [
                'value'=>'Colony Count',
                'parent_id'=>0
            ],
            [
                'value'=>'Condition',
                'parent_id'=>0
            ],
            [
                'value'=>'opt 1',
                'parent_id'=>1
            ],
            [
                'value'=>'opt 2',
                'parent_id'=>1
            ],
            [
                'value'=>'opt 1',
                'parent_id'=>2
            ],
            [
                'value'=>'opt 2',
                'parent_id'=>2
            ],
            [
                'value'=>'opt 1',
                'parent_id'=>3
            ],
            [
                'value'=>'opt 2',
                'parent_id'=>3
            ],
        ]);
    }
}

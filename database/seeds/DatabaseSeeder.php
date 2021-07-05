<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
                PermissionSeeder::class,
                UserSeeder::class,
                CurrencySeeder::class,
                SettingSeeder::class,
                CultureOptionsSeeder::class,
                TestsSeeder::class,
                CulturesSeeder::class,
                PatientSeeder::class,
                BranchSeeder::class,
                LanguageSeeder::class,
            ]);
    }
}

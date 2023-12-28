<?php

namespace Database\Seeders;

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
            PreferenceSeeder::class,
            PermissionSeeder::class,
            ScheduleSeeder::class,
            SportSeeder::class,
            MaterialSeeder::class,
            SportMaterialSeeder::class
        ]);

    }
}

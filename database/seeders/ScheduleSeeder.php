<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [];
        for ($hour = 6; $hour < 24; $hour++) {
            foreach (['00', '30'] as $minute) {
                $times[] = ['horary' => sprintf('%02d:%s', $hour, $minute)];
            }
        }

        DB::table('schedule')->insert($times);
    }
}
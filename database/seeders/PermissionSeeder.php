<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            ['symbol' => 'U', 'slug'=> 'user'],
            ['symbol' => 'A', 'slug'=>'admin'],
            ['symbol' => 'G', 'slug'=> 'guest']
        ]);
    }
}

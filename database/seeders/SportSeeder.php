<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sport')->insert([
            ['name' => 'Futebol', 'default_value_player_numbers' => 11],
            ['name' => 'Basquete', 'default_value_player_numbers' => 5],
            ['name' => 'Skate', 'default_value_player_numbers' => 1],
            ['name' => 'Futsal', 'default_value_player_numbers' => 5],
            ['name' => 'Handebol', 'default_value_player_numbers' => 7],
            ['name' => 'Tênis', 'default_value_player_numbers' => 1],
            ['name' => 'Xadrez', 'default_value_player_numbers' => 1],
            ['name' => 'Natação', 'default_value_player_numbers' => 1],
            ['name' => 'Ping-Pong', 'default_value_player_numbers' => 1],
            ['name' => 'Vôlei', 'default_value_player_numbers' => 6],
            ['name' => 'Vôlei de Praia', 'default_value_player_numbers' => 2],
            ['name' => 'Futevôlei', 'default_value_player_numbers' => 2],
        ]);
    }
}

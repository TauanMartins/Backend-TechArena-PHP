<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            ['description' => 'Bola de futebol'],
            ['description' => 'Bola de basquete'],
            ['description' => 'Skate'],
            ['description' => 'Bola de futsal'],
            ['description' => 'Bola de handebol'],
            ['description' => 'Raquete de tênis'],
            ['description' => 'Bola de tênis'],
            ['description' => 'Tabuleiro de xadrez'],
            ['description' => 'Peças de xadrez'],
            ['description' => 'Relógio de xadrez'],
            ['description' => 'Óculos de natação'],
            ['description' => 'Touca de natação'],
            ['description' => 'Raquete de tênis de mesa'],
            ['description' => 'Bola de tênis de mesa'],
            ['description' => 'Rede de tênis de mesa'],
            ['description' => 'Mesa de tênis de mesa'],
            ['description' => 'Bola de vôlei'],
            ['description' => 'Bola de vôlei de praia'],
            ['description' => 'Bola de futevôlei'],['description' => 'Traves de gol de futebol'],
            ['description' => 'Cesta de basquete (aro, tabela, rede)'],
            ['description' => 'Rampas e trilhos para skate'],
            ['description' => 'Traves de gol de futsal'],
            ['description' => 'Traves de gol de handebol'],
            ['description' => 'Rede de tênis'],
            ['description' => 'Quadra de tênis'],
            ['description' => 'Piscina'],
            ['description' => 'Rede de vôlei'],
            ['description' => 'Postes de vôlei'],
            ['description' => 'Rede de vôlei de praia'],
            ['description' => 'Postes de vôlei de praia'],
            ['description' => 'Areia para vôlei de praia'],
            ['description' => 'Rede de futevôlei'],
            ['description' => 'Postes de futevôlei'],
            ['description' => 'Areia para futevôlei'],
        ];

        DB::table('material')->insert($materials);
    }
}

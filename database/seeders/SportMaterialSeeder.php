<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SportMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sport_materials = [
            // Vôlei
            ['sport_id' => 1, 'material_id' => 20, 'related_to_local' => false], // Bola de vôlei
            ['sport_id' => 1, 'material_id' => 31, 'related_to_local' => true],  // Rede de vôlei
            ['sport_id' => 1, 'material_id' => 32, 'related_to_local' => true],  // Postes de vôlei

            // Futsal
            ['sport_id' => 2, 'material_id' => 7, 'related_to_local' => false],  // Bola de futsal
            ['sport_id' => 2, 'material_id' => 26, 'related_to_local' => true], // Traves de gol de futsal

            // Basquete
            ['sport_id' => 3, 'material_id' => 5, 'related_to_local' => false],  // Bola de basquete
            ['sport_id' => 3, 'material_id' => 24, 'related_to_local' => true], // Cesta de basquete (aro, tabela, rede)

            // Futebol
            ['sport_id' => 4, 'material_id' => 4, 'related_to_local' => false],  // Bola de futebol
            ['sport_id' => 4, 'material_id' => 23, 'related_to_local' => true], // Traves de gol de futebol

            // Skate
            ['sport_id' => 5, 'material_id' => 6, 'related_to_local' => false],  // Skate
            ['sport_id' => 5, 'material_id' => 25, 'related_to_local' => true], // Rampas e trilhos para skate

            // Handebol
            ['sport_id' => 6, 'material_id' => 8, 'related_to_local' => false],  // Bola de handebol
            ['sport_id' => 6, 'material_id' => 27, 'related_to_local' => true], // Traves de gol de handebol

            // Tênis
            ['sport_id' => 7, 'material_id' => 9, 'related_to_local' => false],  // Raquete de tênis
            ['sport_id' => 7, 'material_id' => 10, 'related_to_local' => false], // Bola de tênis
            ['sport_id' => 7, 'material_id' => 28, 'related_to_local' => true], // Rede de tênis
            ['sport_id' => 7, 'material_id' => 29, 'related_to_local' => true], // Quadra de tênis

            // Xadrez
            ['sport_id' => 8, 'material_id' => 11, 'related_to_local' => false], // Tabuleiro de xadrez
            ['sport_id' => 8, 'material_id' => 12, 'related_to_local' => false], // Peças de xadrez
            ['sport_id' => 8, 'material_id' => 13, 'related_to_local' => false], // Relógio de xadrez

            // Natação
            ['sport_id' => 9, 'material_id' => 14, 'related_to_local' => false], // Óculos de natação
            ['sport_id' => 9, 'material_id' => 15, 'related_to_local' => false], // Touca de natação
            ['sport_id' => 9, 'material_id' => 30, 'related_to_local' => true],  // Piscina

            // Ping-Pong (Tênis de Mesa)
            ['sport_id' => 10, 'material_id' => 16, 'related_to_local' => false], // Raquete de tênis de mesa
            ['sport_id' => 10, 'material_id' => 17, 'related_to_local' => false], // Bola de tênis de mesa
            ['sport_id' => 10, 'material_id' => 18, 'related_to_local' => false], // Rede de tênis de mesa
            ['sport_id' => 10, 'material_id' => 19, 'related_to_local' => true],  // Mesa de tênis de mesa

            // Vôlei de Praia
            ['sport_id' => 11, 'material_id' => 21, 'related_to_local' => false], // Bola de vôlei de praia
            ['sport_id' => 11, 'material_id' => 33, 'related_to_local' => true],  // Rede de vôlei de praia
            ['sport_id' => 11, 'material_id' => 34, 'related_to_local' => true],  // Postes de vôlei de praia
            ['sport_id' => 11, 'material_id' => 35, 'related_to_local' => true],  // Areia para vôlei de praia

            // Futevôlei
            ['sport_id' => 12, 'material_id' => 22, 'related_to_local' => false], // Bola de futevôlei
            ['sport_id' => 12, 'material_id' => 36, 'related_to_local' => true],  // Rede de futevôlei
            ['sport_id' => 12, 'material_id' => 37, 'related_to_local' => true],  // Postes de futevôlei
            ['sport_id' => 12, 'material_id' => 38, 'related_to_local' => true],  // Areia para futevôlei
        ];

        DB::table('sport_material')->insert($sport_materials);
    }
}

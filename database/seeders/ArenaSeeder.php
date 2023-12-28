<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ArenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('arena')->insert([
            [
                "address" => "Quadra de Areia SQN 206",
                "lat" => -15.768232,
                "longitude" => -47.8797558,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Areia%20SQN%20206.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes SQN 408",
                "lat" => -15.7611754,
                "longitude" => -47.879193,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Esportes%20SQN%20408.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes SQN 106/107",
                "lat" => -15.7677117,
                "longitude" => -47.8849546,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Esportes%20SQN%20106/107.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra Esportiva SQS 403",
                "lat" => -15.8095609,
                "longitude" => -47.8872044,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20Esportiva%20SQS%20403.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra Esportiva SQS 303",
                "lat" => -15.8030389,
                "longitude" => -47.8930819,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20Esportiva%20SQS%20303.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes SQS 704",
                "lat" => -15.8020031,
                "longitude" => -47.8977909,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Esportes%20SQS%20704.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes SQN 316",
                "lat" => -15.7378265,
                "longitude" => -47.8956642,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Esportes%20SQN%20316.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Q. 301 Rua C - Águas Claras, Brasília - DF",
                "lat" => -15.829449,
                "longitude" => -48.013749,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Q.%20301%20Rua%20C%20-%20%C3%81guas%20Claras%2C%20Bras%C3%ADlia%20-%20DF.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Av. das Araucárias - Águas Claras, Brasília - DF",
                "lat" => -15.838986,
                "longitude" => -48.018718,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Av.%20das%20Arauc%C3%A1rias%20-%20%C3%81guas%20Claras%2C%20Bras%C3%ADlia%20-%20DF.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de esportes comunitária Guará, Brasília - DF",
                "lat" => -15.816357,
                "longitude" => -47.998175,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20esportes%20comunit%C3%A1ria%20Guar%C3%A1%2C%20Bras%C3%ADlia%20-%20DF.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra Poliesportiva da Vila Mathia - Taguatinga Sul",
                "lat" => -15.847699,
                "longitude" => -48.047406,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20Poliesportiva%20da%20Vila%20Mathia%20-%20Taguatinga%20Sul.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes Taguatinga, 72110-600",
                "lat" => -15.817534,
                "longitude" => -48.056075,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Esportes%20Taguatinga%2C%2072110-600.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Basquete do Taguaparque",
                "lat" => -15.811877,
                "longitude" => -48.05517,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Basquete%20do%20Taguaparque.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra Poliesportiva Qsf15 - Taguatinga",
                "lat" => -15.861639,
                "longitude" => -48.039283,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20Poliesportiva%20Qsf15%20-%20Taguatinga.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra da Qsf11 - Taguatinga",
                "lat" => -15.860569,
                "longitude" => -48.038106,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20da%20Qsf11%20-%20Taguatinga.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Skate Park Aguas Claras",
                "lat" => -15.835876,
                "longitude" => -48.038641,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Skate%20Park%20Aguas%20Claras.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Vôlei de Praia - Parque Ecológico Águas Claras",
                "lat" => -15.82984,
                "longitude" => -48.021295,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/V%C3%B4lei%20de%20Praia%20-%20Parque%20Ecol%C3%B3gico%20%C3%81guas%20Claras.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esporte da Quadra 4",
                "lat" => -15.65477,
                "longitude" => -47.7993807,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Basquete%20/%20Futebol%20da%20Quadra%204.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de esportes 210 Asa Sul",
                "lat" => -15.8246872,
                "longitude" => -47.9081546,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20esportes%20210%20Asa%20Sul.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra Esportiva SQN 102",
                "lat" => -15.7816438,
                "longitude" => -47.8819337,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20Esportiva%20SQN%20102.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Skate Park Sukata",
                "lat" => -15.8021049,
                "longitude" => -47.9417339,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Pista%20de%20Skate%20Sukata.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes SQN 206",
                "lat" => -15.7680977,
                "longitude" => -47.8802996,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20Esportes%20SQN%20206.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de futebol EQS 110/111",
                "lat" => -15.8211639,
                "longitude" => -47.9106202,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20de%20futebol%20EQS%20110/111.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadras Poliesportivas - Parque da Cidade",
                "lat" => -15.8101154,
                "longitude" => -47.9219444,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadras%20Poliesportivas%20-%20Parque%20da%20Cidade.jpg",
                "is_league_only" => false,
            ],
            [
                "address" => "Rua 6 - Quadra 6 LE 5",
                "lat" => -15.6528403,
                "longitude" => -47.7989211,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Rua%206%20-%20Quadra%206%20LE%205.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra 06 De Sobradinho",
                "lat" => -15.6486876,
                "longitude" => -47.7985629,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%2006%20De%20Sobradinho.jpg",
                "is_league_only" => false,
            ],
            [
                "address" =>
                    "Condomínio Fazendinha Q 2 Conjunto A, Distrito Federal",
                "lat" => -15.7534151,
                "longitude" => -47.7658537,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Condom%C3%ADnio%20Fazendinha%20Q%202%20Conjunto%20A%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" =>
                    "1428 Condomínio Fazendinha Q 2 Conjunto A, Distrito Federal",
                "lat" => -15.7527877,
                "longitude" => -47.764526,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/1428%20Condom%C3%ADnio%20Fazendinha%20Q%202%20Conjunto%20A%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Condomínio Del Lago I Q 4, Distrito Federal",
                "lat" => -15.7486507,
                "longitude" => -47.7810874,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Condom%C3%ADnio%20Del%20Lago%20I%20Q%204%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Q. 1 Del Lago, Distrito Federal",
                "lat" => -15.7508603,
                "longitude" => -47.7806515,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Q.%201%20Del%20Lago%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra da 9, Paranoá, Brasília DF",
                "lat" => -15.7763966,
                "longitude" => -47.7809614,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20da%209%2C%20Parano%C3%A1%2C%20Bras%C3%ADlia%20DF.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Paranoá 7 Praça Central Conjunto 3, Distrito Federal",
                "lat" => -15.7765671,
                "longitude" => -47.7809677,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Parano%C3%A1%207%20Pra%C3%A7a%20Central%20Conjunto%203%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" => "12 Praça Central, Distrito Federal",
                "lat" => -15.7772657,
                "longitude" => -47.7802508,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/12%20Pra%C3%A7a%20Central%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" =>
                    "Condomínio Mansões Entre Lagos Etapa 2, Distrito Federal",
                "lat" => -15.7400334,
                "longitude" => -47.7526228,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Condom%C3%ADnio%20Mans%C3%B5es%20Entre%20Lagos%20Etapa%202%2C%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" =>
                    "Condomínio Mansões Entre lagos Etapa 2 Distrito Federal",
                "lat" => -15.7400644,
                "longitude" => -47.7526121,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Condom%C3%ADnio%20Mans%C3%B5es%20Entre%20lagos%20Etapa%202%20Distrito%20Federal.png",
                "is_league_only" => false,
            ],
            [
                "address" => "Quadra de Esportes SQN 208",
                "lat" => -15.7621473,
                "longitude" => -47.8815784,
                "image" =>
                    "https://bucket-techarena.s3.sa-east-1.amazonaws.com/arenas/Quadra%20Esportiva%20da%20208%20Norte.jpg",
                "is_league_only" => false,
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SalasSeeder extends Seeder
{
    // Generos - usar esta tabela para associar aos seeds dos filmes
    public static array $salas = [];

    public static array $nomesSalas = [
        "Andromeda",
        "Enterprise",
        "Galatica",
        "Millennium Falcon",
        "X-Wing",
        "Discovery One",
        "Excelsior",
        "Death Star",
    ];

    public static array $lugares = [
        1 => [10, 15],
        2 => [6, 10],
        3 => [10, 8],
        4 => [7, 8],
        5 => [4, 7],
        6 => [4, 6],
        7 => [10, 8],
        8 => [14, 20],
    ];

    public function run()
    {
        $this->command->info("Salas");
        $faker = Factory::create('pt_PT');
        foreach (static::$nomesSalas as $value) {
            DB::table('salas')->insert([
                'nome'       => $value,
                'deleted_at' => $value == "X-Wing" ? $faker->dateTimeBetween('-3 months', '-1 months') : null,
            ]);
        }

        foreach (static::$lugares as $id => $lugares) {
            $this->generateLugares($id, $lugares[0], $lugares[1]);
        }

        DB::update('UPDATE lugares SET deleted_at = (SELECT deleted_at FROM salas WHERE id=5) WHERE sala_id=5');

        static::fillSalasInfo();
    }

    protected function generateLugares($salaId, $filas, $posicoes)
    {
        $alphabet = range('A', 'Z');

        echo $alphabet[3]; // returns D
        $lugares = [];
        for ($i = 1; $i <= $filas; $i++) {
            $fila = $alphabet[$i - 1];
            for ($j = 1; $j <= $posicoes; $j++) {
                $lugares[] = [
                    "sala_id" => $salaId,
                    "fila"    => $fila,
                    "posicao" => $j,
                ];
            }
        }
        DB::table('lugares')->insert($lugares);
    }

    public static function fillSalasInfo()
    {
        foreach (static::$lugares as $id => $lugares) {
            // static::$salas array com todas as salas. Id da sala = chave do array e valor = total de lugares (negativo se sala foi apagada)
            static::$salas[$id] = ($id == 5) ? $lugares[0] * $lugares[1] * -1 : $lugares[0] * $lugares[1];
        }
    }
}

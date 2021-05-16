<?php

namespace Database\Seeders;

use App\Models\Pokemon;
use Illuminate\Database\Seeder;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $header = true;
        if (($handle = fopen(database_path("seeders/pokemon.csv"), "r")) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                if ($header) {
                    $header = false;

                    continue;
                }

                Pokemon::updateOrCreate([
                    'uuid' => md5(data_get($data, '0') . data_get($data, '1')),
                    'num' => data_get($data, '0'),
                    'name' => data_get($data, '1'),
                    'type_1' => data_get($data, '2'),
                    'type_2' => data_get($data, '3'),
                    'total' => data_get($data, '4'),
                    'hp' => data_get($data, '5'),
                    'attack' => data_get($data, '6'),
                    'defense' => data_get($data, '7'),
                    'sp_atk' => data_get($data, '8'),
                    'sp_def' => data_get($data, '9'),
                    'speed' => data_get($data, '10'),
                    'generation' => data_get($data, '11'),
                    'legendary' => (bool)data_get($data, '12'),
                ]);
            }

            fclose($handle);
        }
    }
}

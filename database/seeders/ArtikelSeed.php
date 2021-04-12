<?php

namespace Database\Seeders;

use App\Models\ArtikelModel;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArtikelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i <= 10; $i++) {
            ArtikelModel::create([
                'title'    => $faker->word(),
                'slugs'    => $faker->slug(),
                'body'     => $faker->word(),
                'status'   => $faker->boolean($chanceOfGettingTrue = 70),
                'jenis'    => 'baru',
                'counting_klik' => 0
            ]);
        }
    }
}

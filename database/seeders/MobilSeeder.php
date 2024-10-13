<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run () : void
    {
        $faker = Faker::create ();

        for ( $i = 0; $i < 25; $i++ )
        {
            Mobil::create ( [ 
                'merek'               => $faker->randomElement ( [ 'Toyota', 'Honda', 'Suzuki', 'Ford', 'BMW' ] ),
                'model'               => $faker->word,
                'nomor_plat'          => strtoupper ( $faker->bothify ( '?? #### ??' ) ),
                'tarif_sewa_per_hari' => $faker->numberBetween ( 300000, 5000000 ),
            ] );
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run () : void
    {
        $faker = Faker::create ( 'id_ID' );

        // User::create ( [ 
        //     'name'          => 'Admin',
        //     'username'      => 'admin',
        //     'email'         => 'admin@gmail.com',
        //     'password'      => Hash::make ( 'admin1234' ),
        //     'alamat'        => $faker->address, 
        //     'nomor_telepon' => '+62' . $faker->numerify ( '###########' ),
        //     'nomor_sim'     => $faker->numerify ( '##########' ),
        //     'role'          => 'admin',
        // ] );

        User::create ( [ 
            'name'          => 'User1',
            'username'      => 'user1',
            'email'         => 'user1@gmail.com',
            'password'      => Hash::make ( 'user1234' ),
            'alamat'        => $faker->address,
            'nomor_telepon' => '+62' . $faker->numerify ( '###########' ),
            'nomor_sim'     => $faker->numerify ( '##########' ),
            'role'          => 'user',
        ] );

        User::create ( [ 
            'name'          => 'User2',
            'username'      => 'user2',
            'email'         => 'user2@gmail.com',
            'password'      => Hash::make ( 'user1234' ),
            'alamat'        => $faker->address,
            'nomor_telepon' => '+62' . $faker->numerify ( '###########' ),
            'nomor_sim'     => $faker->numerify ( '##########' ),
            'role'          => 'user',
        ] );

        User::create ( [ 
            'name'          => 'User3',
            'username'      => 'user3',
            'email'         => 'user3@gmail.com',
            'password'      => Hash::make ( 'user1234' ),
            'alamat'        => $faker->address,
            'nomor_telepon' => '+62' . $faker->numerify ( '###########' ),
            'nomor_sim'     => $faker->numerify ( '##########' ),
            'role'          => 'user',
        ] );
    }
}

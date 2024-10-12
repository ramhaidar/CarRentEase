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
        $faker = Faker::create ( 'id_ID' ); // Menggunakan locale Indonesia

        // User::create ( [ 
        //     'name'          => 'Admin',
        //     'username'      => 'admin',
        //     'email'         => 'admin@gmail.com',
        //     'password'      => Hash::make ( 'admin1234' ),
        //     'alamat'        => $faker->address, // Menggunakan Faker untuk alamat
        //     'nomor_telepon' => $faker->phoneNumber, // Menggunakan Faker untuk nomor telepon
        //     'nomor_sim'     => $faker->numerify ( '##########' ), // Menggunakan Faker untuk nomor SIM (angka acak)
        //     'role'          => 'admin',
        // ] );

        User::create ( [ 
            'name'          => 'User',
            'username'      => 'user',
            'email'         => 'user@gmail.com',
            'password'      => Hash::make ( 'user1234' ),
            'alamat'        => $faker->address, // Menggunakan Faker untuk alamat
            'nomor_telepon' => $faker->phoneNumber, // Menggunakan Faker untuk nomor telepon
            'nomor_sim'     => $faker->numerify ( '##########' ), // Menggunakan Faker untuk nomor SIM (angka acak)
            'role'          => 'user',
        ] );
    }
}

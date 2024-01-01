<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'jenis_kelamin' => 'Laki laki',
            'foto' => 'default.jpg',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
        $admin->assignRole('Admin');



        $user = User::create([
            'name' => 'dokter',
            'jenis_kelamin' => 'Laki laki',
            'foto' => 'default.jpg',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('dokter123')
        ]);
        $user->assignRole('Dokter');


        $user = User::create([
            'name' => 'pasien',
            'jenis_kelamin' => 'Laki laki',
            'foto' => 'default.jpg',
            'email' => 'pasien@gmail.com',
            'password' => Hash::make('pasien123')
        ]);
        $user->assignRole('Pasien');
    }
}

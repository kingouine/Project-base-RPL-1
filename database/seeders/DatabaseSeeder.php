<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'nama' => 'Gading',
            'email' => 'gadingpamungkas776@gmail.com',
            'jabatan' => 'Admin',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);
        User::create([
            'nama' => 'Raihan',
            'email' => 'raihan@gmail.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);
        User::create([
            'nama' => 'Naufal',
            'email' => 'naufal@gmail.com',
            'jabatan' => 'Manajer',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);
    }
}

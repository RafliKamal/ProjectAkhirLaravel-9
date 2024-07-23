<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'udin',
            'email' => 'udin@gmail.com',
            'password' =>Hash::make('udin'),
            'role' => 'Dosen', // Tambahkan nilai untuk kolom 'role'
            'user_id' => 'U2',
            'prodi_id' => 'P04', // Tambahkan nilai untuk kolom 'prodi_id'

        ]);
    }
}

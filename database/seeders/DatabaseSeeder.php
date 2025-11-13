<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'marco',
            'email' => 'mamanivillenam@gmail.com',
            'password' => bcrypt('1234'),
            'tipe' => 0
        ]);

        \App\Models\Lider::factory()->create([
            'name' => 'marco',
            'lastname' => 'mamani',
            'birthdate' => '2025-11-10',
            'addres' => 'c/ cochabamba',
            'contact' => '71196186',
            'code' => '+591',
            'foto' => null,
            'user_id' => 1,
            'status' => 1,
        ]);
    }
}

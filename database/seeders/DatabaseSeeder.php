<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'admin biasa',
            'username' => 'admin',
            'password' => bcrypt('12123'),
            'level' => 'admin'
        ]);

        User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'password' => bcrypt('12122'),
            'level' => 'superadmin'
        ]);

        User::create([
            'name' => 'pemilik perusahaan',
            'username' => 'owner',
            'password' => bcrypt('12121'),
            'level' => 'owner'
        ]);
    }
}

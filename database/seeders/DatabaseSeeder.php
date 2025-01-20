<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Diocese;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles if they don't exist
        Role::firstOrCreate(['name' => 'Super Admin']);
        Role::firstOrCreate(['name' => 'Diocese Admin']);
        Role::firstOrCreate(['name' => 'Parish Admin']);

        // Create users and assign roles
        User::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Super Admin');

        User::factory()->create([
            'name' => 'Diocese1',
            'email' => 'Diocese1@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Diocese Admin');

        User::factory()->create([
            'name' => 'Parish1',
            'email' => 'Parish1@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Parish Admin');


        Diocese::create([
            'name' => 'Diocese of Nairobi',
            'code' => 'DN001',
        ]);

        Diocese::create([
            'name' => 'Diocese of Kiambu',
            'code' => 'DN002',
        ]);
    }
}
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seed the users.
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
    }
}
<?php

namespace Database\Seeders;

use App\Models\Deanery;
use Illuminate\Database\Seeder;

class DeanerySeeder extends Seeder
{
    /**
     * Seed the dioceses.
     */
    public function run(): void
    {
        $deaneries = [
            ['code' => '1', 'name' => 'LIMURU', 'diocese_id' => 1],
            ['code' => '2', 'name' => 'GITHUNGURI', 'diocese_id' => 1],
            ['code' => '3', 'name' => 'KIKUYU', 'diocese_id' => 1],
            ['code' => '4', 'name' => 'WESTLANDS', 'diocese_id' => 1],
            ['code' => '5', 'name' => 'KAREN', 'diocese_id' => 1],
            ['code' => '6', 'name' => 'LANGATA', 'diocese_id' => 1],
            ['code' => '7', 'name' => 'CBD', 'diocese_id' => 1],
            ['code' => '8', 'name' => 'EASTLANDS', 'diocese_id' => 1],
            ['code' => '9', 'name' => 'EMBAKASI', 'diocese_id' => 1],
            ['code' => '10', 'name' => 'KASARANI', 'diocese_id' => 2],
            ['code' => '11', 'name' => 'RUIRU', 'diocese_id' => 2],
            ['code' => '12', 'name' => 'THIKA', 'diocese_id' => 2],
            ['code' => '13', 'name' => 'GATUNDU', 'diocese_id' => 2],
            ['code' => '14', 'name' => 'RUARAKA', 'diocese_id' => 2],
        ];

        // Insert deaneries into the database
        foreach ($deaneries as $deanery) {
            Deanery::create($deanery);
        }

}}
<?php

namespace Database\Seeders;

use App\Models\Diocese;
use Illuminate\Database\Seeder;

class DioceseSeeder extends Seeder
{
    /**
     * Seed the dioceses.
     */
    public function run(): void
    {
        $dioceses = [
            ['name' => 'Diocese of Nairobi', 'code' => 'DN001'],
            ['name' => 'Diocese of Kiambu', 'code' => 'DN002'],
        ];

        // Insert dioceses into the database
        foreach ($dioceses as $diocese) {
            Diocese::create($diocese);
        }
    }
}
<?php

namespace Database\Seeders;

use App\Models\Parish;
use Illuminate\Database\Seeder;

class ParishSeeder extends Seeder
{
    /**
     * Seed the dioceses.
     */
    public function run(): void
    {

        $parishes = [
            ['code' => '1', 'name' => 'LORETO', 'deanery_id' => 1],
            ['code' => '1-1', 'name' => 'ST. JAMES', 'deanery_id' => 1],
            ['code' => '2', 'name' => 'KAMBAA', 'deanery_id' => 2],
            ['code' => '3', 'name' => 'NGENYA', 'deanery_id' => 2],
            ['code' => '4', 'name' => 'MARY HELP OF CHRISTIANS NDUNDU', 'deanery_id' => 3],
            ['code' => '5', 'name' => 'ST. PAULS', 'deanery_id' => 4],
            ['code' => '6', 'name' => 'ST. JOHN THE BAPTIST', 'deanery_id' => 4],
            ['code' => '7', 'name' => 'OUR LADY OF THE ROSARY', 'deanery_id' => 5],
            ['code' => '8', 'name' => 'HOLY FAMILY BASILICA', 'deanery_id' => 7],
            ['code' => '9', 'name' => 'ST. PETERS CLAVERS', 'deanery_id' => 7],
            ['code' => '10', 'name' => 'ST. JOSEPHS', 'deanery_id' => 8],
            ['code' => '11', 'name' => 'ST. STEPHENS', 'deanery_id' => 8],
            ['code' => '12', 'name' => 'ST. VERONICAS', 'deanery_id' => 9],
            ['code' => '13', 'name' => 'OUR LADY OF GUADALUPE', 'deanery_id' => 9],
            ['code' => '14', 'name' => 'HOLY CROSS', 'deanery_id' => 10],
            ['code' => '15', 'name' => 'GOOD SHEPHERD', 'deanery_id' => 10],
            ['code' => '16', 'name' => 'ST. TERESA', 'deanery_id' => 11],
            ['code' => '17', 'name' => 'ST. CHARLES LWANGA', 'deanery_id' => 12],
            ['code' => '18', 'name' => 'CHRIST THE KING', 'deanery_id' => 13],
            ['code' => '19', 'name' => 'ST. ANNE\'S', 'deanery_id' => 13],
            ['code' => '20', 'name' => 'ST. BENEDICTS', 'deanery_id' => 14],
            ['code' => '21', 'name' => 'ST. JOAN OF ARC', 'deanery_id' => 14],
        ];

        // Insert parishes into the database
        foreach ($parishes as $parish) {
            Parish::create($parish);
        }

    }
}
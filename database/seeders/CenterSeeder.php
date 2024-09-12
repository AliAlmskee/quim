<?php

namespace Database\Seeders;

use App\Models\Center;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create centers with real data
        $centers = [
            [
                'name' => 'قيم',
                'points_factor' => 1,
                'location' => 'شارع بغداد ',
                'photo' => '1726086479_unnamed.jpg',
            ],
        ];

        foreach ($centers as $center) {
            Center::create($center);
        }

        DB::table('book_center')->insert([
            ['book_id' => 1, 'center_id' => 1],
        ]);
    }
}

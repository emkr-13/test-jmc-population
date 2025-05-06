<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Regency;

class RegenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jogjaRegencies = [
            ['name' => 'Bantul', 'population' => 1000000, 'province_id' => 14],
            ['name' => 'Sleman', 'population' => 1200000, 'province_id' => 14],
            ['name' => 'Kulon Progo', 'population' => 800000, 'province_id' => 14],
            ['name' => 'Gunung Kidul', 'population' => 750000, 'province_id' => 14],
            ['name' => 'Kota Yogyakarta', 'population' => 500000, 'province_id' => 14],
        ];

        Regency::insert($jogjaRegencies);
    }
}

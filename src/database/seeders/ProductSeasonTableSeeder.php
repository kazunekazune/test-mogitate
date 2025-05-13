<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeasonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_season')->insert([
            // 例: キウイ（id=1）は秋・冬
            ['product_id' => 1, 'season_id' => 3], // 秋
            ['product_id' => 1, 'season_id' => 4], // 冬
            ['product_id' => 2, 'season_id' => 1], // 春
            ['product_id' => 3, 'season_id' => 4], // 冬
            ['product_id' => 4, 'season_id' => 2], // 夏
            ['product_id' => 5, 'season_id' => 2], // 夏
            ['product_id' => 6, 'season_id' => 2], // 夏
            ['product_id' => 6, 'season_id' => 3], // 秋
            ['product_id' => 7, 'season_id' => 1], // 春
            ['product_id' => 7, 'season_id' => 2], // 夏
            ['product_id' => 8, 'season_id' => 1], // 春
            ['product_id' => 8, 'season_id' => 3], // 秋
            ['product_id' => 9, 'season_id' => 2], // 夏
            ['product_id' => 10, 'season_id' => 1], // 春
            ['product_id' => 10, 'season_id' => 2], // 夏
        ]);
    }
}

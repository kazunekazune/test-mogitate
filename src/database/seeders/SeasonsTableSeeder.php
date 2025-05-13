<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $seasons = ['春', '夏', '秋', '冬'];
        foreach ($seasons as $season) {
            DB::table('seasons')->insert(['name' => $season]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => 'Planalto',
                'm_lat' => -25.721822,
                'm_lng' => -53.765546,
                'm_zoom' => 15,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => 'Capanema',
                'm_lat' => -25.671490,
                'm_lng' => -53.807569,
                'm_zoom' => 14,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => 'Pranchita',
                'm_lat' => -25.671490,
                'm_lng' => -53.807569,
                'm_zoom' => 14,
                'states_id' => 21,
                'shortcut' => 0
            ],
        ]);
    }
}

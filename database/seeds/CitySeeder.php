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
                'm_lat' => -25.72066349,
                'm_lng' => -53.76537665,
                'm_zoom' => 15,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => 'Capanema',
                'm_lat' => -25.67080372,
                'm_lng' => -53.80558997,
                'm_zoom' => 15,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => "Pérola D'Oeste",
                'm_lat' => -25.82639456,
                'm_lng' => -53.74126186,
                'm_zoom' => 16,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => 'Pranchita',
                'm_lat' => -26.02133094,
                'm_lng' => -53.73852679,
                'm_zoom' => 16,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => 'Santo Antônio do Sudoeste',
                'm_lat' => -26.06711541,
                'm_lng' => -53.72576683,
                'm_zoom' => 15,
                'states_id' => 21,
                'shortcut' => 1
            ],
            [
                'name' => 'Bela Vista da Caroba',
                'm_lat' => -25.88049408,
                'm_lng' => -53.66688317,
                'm_zoom' => 16,
                'states_id' => 21,
                'shortcut' => 1
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_boxes')->insert([
            [
                'name' => 'CX 1',
                'm_lat' => -25.72344942,
                'm_lng' => -53.77624408,
                'description' => 'CAIXA TESTE 1',
                'amount' => 16,
                'busy' => 8,
                'cities_id' => 1
            ],
            [
                'name' => 'CX 2',
                'm_lat' => -25.72667500,
                'm_lng' => -53.77444351,
                'description' => 'CAIXA TESTE 2',
                'amount' => 8,
                'busy' => 3,
                'cities_id' => 1
            ],
            [
                'name' => 'CX 3',
                'm_lat' => -25.72315300,
                'm_lng' => -53.77481123,
                'description' => 'CAIXA TESTE 3',
                'amount' => 16,
                'busy' => 13,
                'cities_id' => 1
            ],
        ]);
    }
}
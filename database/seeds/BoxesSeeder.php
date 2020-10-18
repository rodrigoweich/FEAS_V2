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
                'name' => 'PON 7 NAP 06',
                'm_lat' => -25.71414286030673,
                'm_lng' => -53.77026189118624,
                'description' => 'PON 7 NAP 06',
                'amount' => 16,
                'busy' => 16,
                'cities_id' => 1
            ],
            [
                'name' => 'PON 8 NAP 4',
                'm_lat' => -25.71704031609957,
                'm_lng' => -53.77457400318235,
                'description' => 'PON 8 NAP 4',
                'amount' => 16,
                'busy' => 16,
                'cities_id' => 1
            ],
            [
                'name' => 'PON 6 NAP 01',
                'm_lat' => -25.725876124815326,
                'm_lng' => -53.761321404335966,
                'description' => 'PON 6 NAP 01',
                'amount' => 16,
                'busy' => 10,
                'cities_id' => 1
            ],
            [
                'name' => 'PON 4 NAP 04',
                'm_lat' => -25.717980342892563,
                'm_lng' => -53.764357469044626,
                'description' => 'PON 4 NAP 04',
                'amount' => 16,
                'busy' => 4,
                'cities_id' => 1
            ],
            [
                'name' => 'PON 4 NAP 05',
                'm_lat' => -25.717091063236936,
                'm_lng' => -53.76396318431944,
                'description' => 'PON 4 NAP 05',
                'amount' => 16,
                'busy' => 9,
                'cities_id' => 1
            ],
            [
                'name' => 'PON 4 NAP 06',
                'm_lat' => -25.71642893221928,
                'm_lng' => -53.763880035839975,
                'description' => 'PON 4 NAP 06',
                'amount' => 16,
                'busy' => 9,
                'cities_id' => 1
            ],
        ]);
    }
}
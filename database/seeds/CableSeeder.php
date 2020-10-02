<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cables')->insert([
            [
                'name' => 'DROP FLAT 1 VIA FTTX - OVERTEK',
                'color' => '#9933FF',
                'dotted' => 0,
                'dotted_repeat' => 0,
                'size' => 3
            ],
            [
                'name' => 'Drop Fig.8 2 FO',
                'color' => '#00CC00',
                'dotted' => 0,
                'dotted_repeat' => 0,
                'size' => 3
            ],
            [
                'name' => 'AS 80 12 FO',
                'color' => '#0000FF',
                'dotted' => 0,
                'dotted_repeat' => 0,
                'size' => 3
            ],
        ]);
    }
}

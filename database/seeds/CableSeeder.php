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
                'size' => 3,
                'dotted_repeat' => null
            ],
            [
                'name' => 'Drop Fig.8 2 FO',
                'color' => '#00CC00',
                'dotted' => 0,
                'size' => 3,
                'dotted_repeat' => null
            ],
            [
                'name' => 'AS 80 12 FO',
                'color' => '#0000FF',
                'dotted' => 0,
                'size' => 3,
                'dotted_repeat' => null
            ],
            [
                'name' => 'DROP FLAT PONT',
                'color' => '#ff1a30',
                'dotted' => 1,
                'size' => 4,
                'dotted_repeat' => 19
            ],
            [
                'name' => 'DROP FLAT PONT AS FO 2.3 FTTXS',
                'color' => '#fff133',
                'dotted' => 1,
                'size' => 6,
                'dotted_repeat' => 24
            ],
        ]);
    }
}

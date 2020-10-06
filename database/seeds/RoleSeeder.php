<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Administrador', 'unalterable' => 1],
            ['name' => 'Técnico', 'unalterable' => 0],
            ['name' => 'Viabilidade', 'unalterable' => 0],
            ['name' => 'Operacional', 'unalterable' => 0],
            ['name' => 'Mapper', 'unalterable' => 0],
            ['name' => 'Comercial', 'unalterable' => 0],
            ['name' => 'Avançar todos', 'unalterable' => 0],
            ['name' => 'Retornar todos', 'unalterable' => 0],
            ['name' => 'Reporter', 'unalterable' => 0]
        ]);
    }
}

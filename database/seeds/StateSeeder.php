<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            ['name' => 'Rondônia', 'uf' => 'RO'],
            ['name' => 'Acre', 'uf' => 'AC'],
            ['name' => 'Amazonas', 'uf' => 'AM'],
            ['name' => 'Roraima', 'uf' => 'RR'],
            ['name' => 'Pará', 'uf' => 'PA'],
            ['name' => 'Amapá', 'uf' => 'AP'],
            ['name' => 'Tocantins', 'uf' => 'TO'],
            ['name' => 'Maranhão', 'uf' => 'MA'],
            ['name' => 'Piauí', 'uf' => 'PI'],
            ['name' => 'Ceará', 'uf' => 'CE'],
            ['name' => 'Rio Grande do Norte', 'uf' => 'RN'],
            ['name' => 'Paraíba', 'uf' => 'PB'],
            ['name' => 'Pernambuco', 'uf' => 'PE'],
            ['name' => 'Alagoas', 'uf' => 'AL'],
            ['name' => 'Sergipe', 'uf' => 'SE'],
            ['name' => 'Bahia', 'uf' => 'BA'],
            ['name' => 'Minas Gerais', 'uf' => 'MG'],
            ['name' => 'Espírito Santo', 'uf' => 'ES'],
            ['name' => 'Rio de Janeiro', 'uf' => 'RJ'],
            ['name' => 'São Paulo', 'uf' => 'SP'],
            ['name' => 'Paraná', 'uf' => 'PR'],
            ['name' => 'Santa Catarina', 'uf' => 'SC'],
            ['name' => 'Rio Grande do Sul', 'uf' => 'RS'],
            ['name' => 'Mato Grosso do Sul', 'uf' => 'MS'],
            ['name' => 'Mato Grosso', 'uf' => 'MT'],
            ['name' => 'Goiás', 'uf' => 'GO'],
            ['name' => 'Distrito Federal', 'uf' => 'DF']
        ]);
    }
}

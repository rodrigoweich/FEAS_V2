<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Rodrigo Gomes Weich',
                'email' => 'rodrigoweich@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 1
            ],
            [
                'name' => 'Teste',
                'email' => 'teste@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ]
        ]);
    }
}

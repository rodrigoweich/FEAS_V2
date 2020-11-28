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
                'name' => 'Comercial',
                'email' => 'comercial@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Viabilidade',
                'email' => 'viabilidade@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Operacional',
                'email' => 'operacional@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Técnico',
                'email' => 'tecnico@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'SAC',
                'email' => 'sac@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Reporter',
                'email' => 'reporter@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
        ]);
    }
}

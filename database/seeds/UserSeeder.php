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
                'name' => 'Usuário deletado',
                'email' => 'deleteduser@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 2',
                'email' => 'teste2@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 3',
                'email' => 'teste3@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 4',
                'email' => 'teste4@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 5',
                'email' => 'teste5@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 6',
                'email' => 'teste6@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 7',
                'email' => 'teste7@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste 8',
                'email' => 'teste8@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
        ]);
    }
}

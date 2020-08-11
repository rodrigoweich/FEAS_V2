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
                'name' => 'Teste Rodrigo Gomes Weich',
                'email' => 'teste@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste1@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste2@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste3@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste4@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste5@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste6@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste7@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste8@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste9@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste10@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste11@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste12@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste13@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste14@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste15@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste16@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste17@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste18@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste19@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ],
            [
                'name' => 'Teste',
                'email' => 'teste20@feas.com',
                'password' => Hash::make('12345678'),
                'unalterable' => 0
            ]
        ]);
    }
}

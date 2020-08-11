<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RuleSeeder::class,
            RoleSeeder::class,
            RuleRoleSeeder::class,
            RoleUserSeeder::class,
            StateSeeder::class,
            CitySeeder::class
        ]);
    }
}

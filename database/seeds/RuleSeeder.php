<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->insert([
            // USER
            ['police_name' => 'list-user', 'display_name' => 'List Users'],
            ['police_name' => 'create-user', 'display_name' => 'Create Users'],
            ['police_name' => 'update-user', 'display_name' => 'Update Users'],
            ['police_name' => 'delete-user', 'display_name' => 'Delete Users'],
            // ROLES
            ['police_name' => 'list-roles', 'display_name' => 'List Roles'],
            ['police_name' => 'create-roles', 'display_name' => 'Create Roles'],
            ['police_name' => 'update-roles', 'display_name' => 'Update Roles'],
            ['police_name' => 'delete-roles', 'display_name' => 'Delete Roles'],
        ]);
    }
}

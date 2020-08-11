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
            ['police_name' => 'list-users', 'display_name' => 'List Users'],
            ['police_name' => 'create-users', 'display_name' => 'Create Users'],
            ['police_name' => 'update-users', 'display_name' => 'Update Users'],
            ['police_name' => 'delete-users', 'display_name' => 'Delete Users'],
            // ROLES
            ['police_name' => 'list-roles', 'display_name' => 'List Roles'],
            ['police_name' => 'create-roles', 'display_name' => 'Create Roles'],
            ['police_name' => 'update-roles', 'display_name' => 'Update Roles'],
            ['police_name' => 'delete-roles', 'display_name' => 'Delete Roles'],
            // CITIES
            ['police_name' => 'list-cities', 'display_name' => 'List Cities'],
            ['police_name' => 'create-cities', 'display_name' => 'Create Cities'],
            ['police_name' => 'update-cities', 'display_name' => 'Update Cities'],
            ['police_name' => 'delete-cities', 'display_name' => 'Delete Cities'],
            // STATES
            ['police_name' => 'list-states', 'display_name' => 'List States'],
            ['police_name' => 'create-states', 'display_name' => 'Create States'],
            ['police_name' => 'update-states', 'display_name' => 'Update States'],
            ['police_name' => 'delete-states', 'display_name' => 'Delete States'],
        ]);
    }
}
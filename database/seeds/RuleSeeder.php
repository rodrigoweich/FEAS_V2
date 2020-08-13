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
            // STATES
            ['police_name' => 'list-states', 'display_name' => 'List States'],
            ['police_name' => 'create-states', 'display_name' => 'Create States'],
            ['police_name' => 'update-states', 'display_name' => 'Update States'],
            ['police_name' => 'delete-states', 'display_name' => 'Delete States'],
            // CITIES
            ['police_name' => 'list-cities', 'display_name' => 'List Cities'],
            ['police_name' => 'create-cities', 'display_name' => 'Create Cities'],
            ['police_name' => 'update-cities', 'display_name' => 'Update Cities'],
            ['police_name' => 'delete-cities', 'display_name' => 'Delete Cities'],
            // NOTICES
            ['police_name' => 'list-notices', 'display_name' => 'List Notices'],
            ['police_name' => 'create-notices', 'display_name' => 'Create Notices'],
            ['police_name' => 'update-notices', 'display_name' => 'Update Notices'],
            ['police_name' => 'delete-notices', 'display_name' => 'Delete Notices'],
            // NOTICES
            ['police_name' => 'list-customers', 'display_name' => 'List Customers'],
            ['police_name' => 'update-customers', 'display_name' => 'Update Customers'],
            ['police_name' => 'delete-customers', 'display_name' => 'Delete Customers'],
            // CABLES
            ['police_name' => 'list-cables', 'display_name' => 'List Cables'],
            ['police_name' => 'create-cables', 'display_name' => 'Create Cables'],
            ['police_name' => 'update-cables', 'display_name' => 'Update Cables'],
            ['police_name' => 'delete-cables', 'display_name' => 'Delete Cables'],
        ]);
    }
}

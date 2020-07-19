<?php

use Illuminate\Database\Seeder;
use App\Rule;
use App\Role;

class RuleRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = Rule::all();
        $role = Role::find(1);
        $role->rules()->attach($rules);
    }
}

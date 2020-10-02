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
        $administrator_rules = Rule::all();
        $administrator_role = Role::find(1);
        $administrator_role->rules()->attach($administrator_rules);

        $commercial_rules = Rule::find([31, 32, 33, 43, 45]);
        $commercial_role = Role::find(6);
        $commercial_role->rules()->attach($commercial_rules);

        $viability_rules = Rule::find([34, 35, 46, 49]);
        $viability_role = Role::find(3);
        $viability_role->rules()->attach($viability_rules);

        $operational_rules = Rule::find([36, 37, 47, 50]);
        $operational_role = Role::find(4);
        $operational_role->rules()->attach($operational_rules);
        
        $technician_rules = Rule::find([38, 39, 48, 51]);
        $technician_role = Role::find(2);
        $technician_role->rules()->attach($technician_rules);
        
        $mapper_rules = Rule::find([40, 41, 42, 52]);
        $mapper_role = Role::find(5);
        $mapper_role->rules()->attach($mapper_rules);

        $next_all_rules = Rule::find([45, 46, 47, 48, 31, 34, 36, 38]);
        $next_all_role = Role::find(7);
        $next_all_role->rules()->attach($next_all_rules);
        
        $previous_all_rules = Rule::find([49, 50, 51, 52, 34, 36, 38, 40]);
        $previous_all_role = Role::find(8);
        $previous_all_role->rules()->attach($previous_all_rules);
    }
}

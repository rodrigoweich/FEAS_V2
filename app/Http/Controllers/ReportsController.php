<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Role;
use App\Rule;
use App\City;
use App\State;
use App\Cable;
use App\ServiceBox;

class ReportsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $count_users = User::all()->count();
        $count_roles = Role::all()->count();
        $count_rules = Rule::all()->count();
        $count_cities = City::all()->count();
        $count_states = State::all()->count();
        $count_cables = Cable::all()->count();
        $count_boxes = ServiceBox::all()->count();

        $all_cities = City::all();

        return view('reports.index')->with([
            'users' => $count_users,
            'roles' => $count_roles,
            'rules' => $count_rules,
            'cities' => $count_cities,
            'all_cities' => $all_cities,
            'states' => $count_states,
            'cables' => $count_cables,
            'boxes' => $count_boxes
        ]);
    }

}

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
use App\Process;
use App\ServiceBox;
use App\Customer;
use DB;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(Gate::denies('free-access-for-reports')){
            return view('403');
        }

        $count_users = User::all()->count();
        $count_roles = Role::all()->count();
        $count_rules = Rule::all()->count();
        $count_cities = City::all()->count();
        $count_states = State::all()->count();
        $count_cables = Cable::all()->count();
        $count_boxes = ServiceBox::all()->count();
        $count_processes = Process::withTrashed()->get()->count();

        $all_cities = City::all();
        $boxes = ServiceBox::all();
        $cables = Cable::all();
        $technicians = DB::table('users')
        ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
        ->select('users.name', 'users.id')
        ->groupBy('users.name', 'users.id', 'role_user.role_id')
        ->orderByRaw('FIELD(role_user.role_id, 2) DESC')
        ->get();
        $customers = Customer::all();

        return view('reports.index')->with([
            'users' => $count_users,
            'roles' => $count_roles,
            'rules' => $count_rules,
            'cities' => $count_cities,
            'all_cities' => $all_cities,
            'states' => $count_states,
            'cables' => $cables,
            'technicians' => $technicians,
            'boxes' => $boxes,
            'processes' => $count_processes,
            'customers' => $customers
        ]);
    }

}

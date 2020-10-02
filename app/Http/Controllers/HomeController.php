<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\City;
use App\State;
use App\Notice;
use App\Process;
use App\Cable;
use App\ServiceBox;
use App\Customer;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_users = User::all()->count();
        $count_roles = Role::all()->count();
        $count_cities = City::all()->count();
        $count_states = State::all()->count();
        $count_notices = Notice::all()->count();
        $count_processes_stage_one = Process::where('stage', '=', 0)->count();
        $count_processes_stage_two = Process::where('stage', '=', 1)->count();
        $count_processes_stage_three = Process::where('stage', '=', 2)->count();
        $count_processes_stage_four = Process::where('stage', '=', 3)->count();
        $count_processes_stage_five = Process::where('stage', '=', 4)->count();
        $count_processes_history = Process::orderBy('id', 'desc')->where('users_id', Auth::user()->id)->withTrashed()->count();
        $count_processes_list = Process::orderBy('id', 'desc')->withTrashed()->count();
        $count_cables = Cable::all()->count();
        $count_boxes = ServiceBox::all()->count();

        $process = Process::get()->last();
        $customer = Customer::all();

        return view('home')->with([
            'users' => $count_users,
            'roles' => $count_roles,
            'cities' => $count_cities,
            'states' => $count_states,
            'notices' => $count_notices,
            'processes_stage_one' => $count_processes_stage_one,
            'processes_stage_two' => $count_processes_stage_two,
            'processes_stage_three' => $count_processes_stage_three,
            'processes_stage_four' => $count_processes_stage_four,
            'processes_stage_five' => $count_processes_stage_five,
            'processes_history' => $count_processes_history,
            'processes_list' => $count_processes_list,
            'cables' => $count_cables,
            'boxes' => $count_boxes,
            'process' => $process,
            'customer' => $customer,
            'notices' => Notice::where('active', 1)->get()
        ]);
    }
}

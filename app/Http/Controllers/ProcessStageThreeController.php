<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Process;
use App\City;
use App\Customer;
use App\Address;
Use App\User;
use DB;
use App\Http\Requests\ProcessStageThreeRequest;

class ProcessStageThreeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index_stage_three()
    {
        if(Gate::denies('list-process-stage-three')){
            return view('403');
        }

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        return view('default.process_stage_three.index')->with([
            'response' => Process::orderBy('id', 'desc')->where('stage', 2)->paginate(15),
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

    public function edit_stage_three($id)
    {
        if(Gate::denies('update-process-stage-three')){
            return view('403');
        }

        $response = Process::find($id);
        $users = DB::table('users')
        ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
        ->select('users.name', 'users.id')
        ->groupBy('users.name', 'users.id', 'role_user.role_id')
        ->orderByRaw('FIELD(role_user.role_id, 2) DESC')
        ->get();
        $city = City::all();

        return view('default.process_stage_three.edit')->with([
            'response' => $response,
            'users' => $users,
            "cities" => $city
        ]);
    }

    public function update_stage_three(ProcessStageThreeRequest $request, $id)
    {
        if(Gate::denies('update-process-stage-three')){
            return view('403');
        }

        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                //$process->users_id = Auth::user()->id;
                $process->responsible_id = $request->responsible_id;
                $process->stage = 2;
                $process->save();
                return redirect()->route('default.process_stage_three.index');
            }
        }

        return redirect()->route('default.process_stage_three.index');
    }

    public function search(Request $request) {
        if(Gate::denies('list-process-stage-three')){
            return view('403');
        }

        $process = DB::table('processes')->where('processes.stage', '=', 2)
        ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
        ->leftjoin('users', 'processes.users_id', '=', 'users.id')
        ->where(function ($query) use ($request){
            $query->whereDate('processes.created_at', $request->dataToSearch)
            ->orWhere('customers.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('users.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('cities.name', 'like', '%'.$request->dataToSearch.'%');
        })
        ->select('processes.id', 'processes.customers_id', 'processes.users_id', 'processes.created_at', 'customers.name', 'cities.name', 'users.name', 'addresses.cities_id', 'processes.responsible_id')
        ->orderBy('processes.id', 'DESC')
        ->paginate(15);

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        $teste = [];
        foreach($cities as $c) {
            $teste += array($c->id => HasController::hasBoxesInTheCity($c->id));
        }

        return view('default.process_stage_three.index')->with([
            'response' => $process,
            'hasBoxes' => HasController::hasBoxes(),
            'haveBoxesByCity' => $teste,
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }
}

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
        $users = User::all();
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
                $process->users_id = Auth::user()->id;
                $process->responsible_id = $request->responsible_id;
                $process->stage = 2;
                $process->save();
                return redirect()->route('default.process_stage_three.index');
            }
        }

        return redirect()->route('default.process_stage_three.index');
    }
}

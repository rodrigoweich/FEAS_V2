<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Process;
use App\City;
use App\Customer;
use App\Address;
use App\ServiceBox;
Use App\User;
use App\Http\Requests\ProcessStageTwoRequest;
use DB;

class ProcessStageTwoController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function index_stage_two()
    {
        if(Gate::denies('list-process-stage-two')){
            return view('403');
        }

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        $teste = [];
        foreach($cities as $c) {
            $teste += array($c->id => HasController::hasBoxesInTheCity($c->id));
        }

        return view('default.process_stage_two.index')->with([
            'response' => Process::orderBy('id', 'desc')->where('stage', 1)->paginate(15),
            'hasBoxes' => HasController::hasBoxes(),
            'haveBoxesByCity' => $teste,
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

    public function edit_stage_two($id)
    {
        if(Gate::denies('update-process-stage-two')){
            return view('403');
        }

        $response = Process::find($id);
        $boxes = ServiceBox::where('cities_id', $response->address()->get()->first()->cities_id)->get();
        $city = City::all();

        return view('default.process_stage_two.edit')->with([
            'response' => $response,
            'boxes' => $boxes,
            "cities" => $city
        ]);
    }

    public function update_stage_two(ProcessStageTwoRequest $request, $id)
    {
        if(Gate::denies('update-process-stage-two')){
            return view('403');
        }

        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                $customer = Customer::find($process->customer()->get()->first()->id);
                $customer->contract_number = $request->contract_number;
                $customer->name = $request->name;
                $customer->surname = $request->surname;
                $customer->phone = $request->phone;
                $customer->m_lat = $request->lat;
                $customer->m_lng = $request->lng;
                $customer->m_zoom = $request->zoom;
                $customer->m_icon = $request->icon;
                $customer->service_boxes_id = $request->box;
                $customer->save();

                $address = Address::find($process->address()->get()->first()->id);
                $address->number = $request->number;
                $address->complement = $request->complement;
                $address->end_description = $request->end_description;
                $address->cities_id = $request->city;
                $address->customers_id = $request->zoom;
                $customer->address()->save($address);

                $process->users_id = Auth::user()->id;
                $process->stage = 1;
                $customer->process()->save($process);
                return redirect()->route('default.process_stage_two.index');
            }
        }

        return redirect()->route('default.process_stage_two.index');
    }

    public function search(Request $request) {
        if(Gate::denies('list-process-stage-two')){
            return view('403');
        }

        $process = DB::table('processes')->where('processes.stage', '=', 1)
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
        ->select('processes.id', 'processes.customers_id', 'processes.users_id', 'processes.created_at', 'customers.name', 'cities.name', 'users.name', 'addresses.cities_id')
        ->orderBy('id', 'DESC')
        ->paginate(15);

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        $teste = [];
        foreach($cities as $c) {
            $teste += array($c->id => HasController::hasBoxesInTheCity($c->id));
        }

        return view('default.process_stage_two.index')->with([
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

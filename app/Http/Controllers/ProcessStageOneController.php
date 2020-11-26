<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
Use App\User;
use App\City;
use App\Customer;
use App\Address;
use App\Process;
use App\ProcessLog;
use DB;
use App\Http\Requests\ProcessStageOneRequest;
use Illuminate\Support\Facades\Log;

class ProcessStageOneController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index_stage_one()
    {
        if(Gate::denies('list-process-stage-one')){
            return view('403');
        }
        
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();
        $cities = City::all();
        return view('default.process_stage_one.index')->with([
            'response' => Process::orderBy('id', 'desc')->where('stage', 0)->paginate(15),
            'hasCities' => HasController::hasCities(),
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

    public function create_stage_one()
    {
        if(Gate::denies('create-process-stage-one')){
            return view('403');
        }

        $cities = City::where('shortcut', 1)->get();
        $city = City::all();
        $customers = Customer::all();
        return view('default.process_stage_one.create')->with([
            'shortcuts' => $cities,
            "cities" => $city,
            'customers' => $customers
        ]);
    }

    public function store_stage_one(ProcessStageOneRequest $request)
    {
        if(Gate::denies('create-process-stage-one')){
            return view('403');
        }

        $customer = new Customer;
        $customer->contract_number = $request->contract_number;
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->m_lat = $request->lat;
        $customer->m_lng = $request->lng;
        $customer->m_zoom = $request->zoom;
        $customer->m_icon = $request->icon;
        $customer->service_boxes_id = null;
        $customer->save();

        $address = new Address;
        $address->number = $request->number;
        $address->complement = $request->complement;
        $address->end_description = $request->end_description;
        $address->cities_id = $request->city;
        $address->customers_id = $request->zoom;
        $customer->address()->save($address);

        $process = new Process;
        $process->users_id = Auth::user()->id;
        $process->stage = 0;
        $customer->process()->save($process);

        $comment = new ProcessLog;
        $comment->description = 'Processo iniciado';
        $comment->processes_id = $process;
        $comment->stage = $process->stage;
        $comment->users_id = Auth::user()->id;
        $comment->current_stage = 11;
        $comment->next_stage = 0;
        $process->process_logs()->save($comment);

        Log::info(trim(Auth::user()->name . ' iniciou um processo [Código: '. $process->id .'] [Viabilidade]' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));

        return redirect()->route('default.process_stage_one.index');
    }

    public function edit_stage_one($id)
    {
        if(Gate::denies('update-process-stage-one')){
            return view('403');
        }
        
        if(isset($id)) {
            $response = Process::find($id);
            if(!$response) {
                return view('404');
            } else {
                if($response->stage > 0) {
                    return view('disabled');
                } else {
                    $city = City::all();

                    return view('default.process_stage_one.edit')->with([
                        'response' => $response,
                        "cities" => $city
                    ]);
                }
            }
        }
        return redirect()->route('default.process_stage_one.index');
    }

    public function update_stage_one(ProcessStageOneRequest $request, $id)
    {
        if(Gate::denies('update-process-stage-one')){
            return view('403');
        }

        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                if($process->stage > 0) {
                    return view('disabled');
                } else {
                    $customer = Customer::find($process->customer()->get()->first()->id);
                    $customer->contract_number = $request->contract_number;
                    $customer->name = $request->name;
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

                    Log::info(trim(Auth::user()->name . ' editou o processo de código '. $process->id . ' [Comercial]' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));
                    return redirect()->route('default.process_stage_one.index');
                }
            }
        }

        return redirect()->route('default.process_stage_one.index');
    }

    public function search(Request $request) {
        if(Gate::denies('list-process-stage-one')){
            return view('403');
        }

        $process = DB::table('processes')->where('processes.stage', '=', 0)
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
        ->select('processes.id', 'processes.customers_id', 'processes.users_id', 'processes.created_at', 'customers.name', 'cities.name', 'users.name')
        ->orderBy('processes.id', 'DESC')
        ->paginate(15);

        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();
        $cities = City::all();
        return view('default.process_stage_one.index')->with([
            'response' => $process,
            'hasCities' => HasController::hasCities(),
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }
}

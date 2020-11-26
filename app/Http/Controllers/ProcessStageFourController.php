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
Use App\Cable;
Use App\User;
Use App\ProcessPhotos;
use DB;
use App\Http\Requests\ProcessStageFourRequest;

use Notification;
use App\Notifications\RequestNotification;
use Illuminate\Support\Facades\Log;

class ProcessStageFourController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index_stage_four()
    {
        if(Gate::denies('list-process-stage-four')){
            return view('403');
        }

        $process = Process::orderBy('id', 'desc')->where('stage', 3)->paginate(15);
        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        return view('default.process_stage_four.index')->with([
            'response' => $process,
            'hasCables' => HasController::hasCables(),
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

    public function edit_stage_four($id)
    {
        if(Gate::denies('update-process-stage-four')){
            return view('403');
        }
        
        if(isset($id)) {
            $response = Process::find($id);
            if(!$response) {
                return view('404');
            } else {
                if($response->stage > 3) {
                    return view('disabled');
                } else if($response->responsible_id != Auth::user()->id) {
                    return view('403');
                } else {
                    $boxes = ServiceBox::where('cities_id', $response->address()->get()->first()->cities_id)->get();
                    $selectedBox = ServiceBox::where('id', $response->customer()->get()->first()->service_boxes_id)->get();
                    $cables = Cable::all();
                    $city = City::all();

                    return view('default.process_stage_four.edit3')->with([
                        'response' => $response,
                        'boxes' => $boxes,
                        'cables' => $cables,
                        "cities" => $city,
                        "selectedBox" => $selectedBox
                    ]);
                }
            }
        }
        return redirect()->route('default.process_stage_four.index');
    }

    public function update_stage_four(ProcessStageFourRequest $request, $id)
    {
        if(Gate::denies('update-process-stage-four')){
            return view('403');
        }

        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                if($process->stage > 3) {
                    return view('disabled');
                } else if($process->responsible_id != Auth::user()->id) {
                    return view('403');
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
    
                    //$process->users_id = Auth::user()->id;
                    $process->stage = 3;
                    $process->meters = $request->distance;
                    $process->real_meters = $request->real_meters;
                    $process->difficulty = $request->note;
                    $process->route = $request->route;
                    $process->cables_id = $request->cable_id;
                    $process->comments = $request->comments;
                    $customer->process()->save($process);

                    $box = ServiceBox::where('id', $customer->service_boxes_id)->first();
                    $box->busy += 1;
                    $box->save();
    
                    if($request->hasfile('photos'))
                    {
                        foreach($request->file('photos') as $file)
                        {
                            $name = $process->id.'-'.time().'-'.$file->getClientOriginalName();
                            $file->move(public_path().'/process_photos/', $name);  
                            $data[] = $name;  
                        }
                        $photos = new ProcessPhotos;
                        $photos->name = json_encode($data);
                        $photos->processes_id = $process;
                        $process->process_photos()->save($photos);
                    }

                    Log::info(trim(Auth::user()->name . ' editou o processo de código '. $process->id . ' [Técnico]' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));
                    return redirect()->route('default.process_stage_four.index');
                }
            }
        }

        return redirect()->route('default.process_stage_four.index');
    }

    public static function sendTelegramMessage($id) {
        $process = Process::find($id);
        $address = Address::find($process->address()->get()->first()->id)->cities_id;
        $customer = Customer::find($process->customer()->get()->first()->id);

        $process->notified += 1;
        $customer->process()->save($process);

        $data = [
            "user_name" => Auth::user()->name,
            "process_id" => $process->id,
            "customer_name" => Customer::find($process->customer()->get()->first()->id)->name,
            "customer_city" => City::find($address)->name,
            "requests" => $process->notified,
            "process_update" => $process->updated_at
        ];
        Notification::route('telegram', '-458942798')
            ->notify(new RequestNotification($data));
        return redirect()->route('default.process_stage_four.index');
    }

    public function search(Request $request) {
        if(Gate::denies('list-process-stage-four')){
            return view('403');
        }

        $process = DB::table('processes')->where('processes.stage', '=', 3)
        ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
        ->leftjoin('users', 'processes.users_id', '=', 'users.id')
        ->leftjoin('users as tech', 'processes.responsible_id', '=', 'tech.id')
        ->where(function ($query) use ($request){
            $query->whereDate('processes.created_at', $request->dataToSearch)
            ->orWhere('customers.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('users.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('tech.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('cities.name', 'like', '%'.$request->dataToSearch.'%');
        })
        ->select('processes.id', 'processes.customers_id', 'processes.users_id', 'processes.created_at', 'customers.name', 'cities.name', 'users.name', 'addresses.cities_id', 'processes.responsible_id', 'processes.route')
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

        return view('default.process_stage_four.index')->with([
            'response' => $process,
            'hasCables' => HasController::hasCables(),
            'haveBoxesByCity' => $teste,
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }
}

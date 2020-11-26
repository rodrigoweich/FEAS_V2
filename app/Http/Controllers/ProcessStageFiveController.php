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
use DB;
Use App\ProcessPhotos;
Use App\ProcessLog;

use Notification;
use App\Notifications\SolvedNotification;
use Illuminate\Support\Facades\Log;

class ProcessStageFiveController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index_stage_five()
    {
        if(Gate::denies('list-process-stage-five')){
            return view('403');
        }

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        return view('default.process_stage_five.index')->with([
            'response' => Process::orderBy('id', 'desc')->where('stage', 4)->paginate(15),
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

    public function edit_stage_five($id)
    {
        if(Gate::denies('update-process-stage-five')){
            return view('403');
        }

        $response = Process::find($id);
        $selectedBox = ServiceBox::where('id', $response->customer()->get()->first()->service_boxes_id)->first();
        $cable = Cable::where('id', $response->cables_id)->first();
        $route = json_decode($response->route, true)["i"];
        $city = City::all();
        $photos = json_decode(ProcessPhotos::where('processes_id', $response->id)->get(), true);
        if($photos) {
            $photos_name = [];
            foreach($photos as $a) {
                foreach(json_decode($a["name"], true) as $b) {
                    array_push($photos_name, $b);
                }
            }
            $photos = $photos_name;
        }

        Log::info(trim(Auth::user()->name . ' realizou a conferência do processo de código '. $response->id . ' [SAC]' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $response));
        
        return view('default.process_stage_five.edit')->with([
            'response' => $response,
            "cities" => $city,
            "selectedBox" => $selectedBox,
            "route" => $route,
            "cable" => $cable,
            "photos" => $photos
        ]);
    }

    public function destroy_process($id)
    {
        if(Gate::denies('delete-process-stage-five')){
            return view('403');
        }

        if(isset($id)) {
            $data = Process::find($id);
            if(!$data) {
                return view('404');
            } else {
                $comment = new ProcessLog;
                $comment->description = 'Processo finalizado';
                $comment->processes_id = $data->id;
                $comment->stage = $data->stage;
                $comment->users_id = Auth::user()->id;
                $comment->current_stage = 4;
                $comment->next_stage = 5;
                $data->process_logs()->save($comment);

                $data->stage = 5;
                $data->users_id_finished = Auth::user()->id;
                $data->save();
                $this->sendSolvedTelegramMessage($data->id);
                Log::info(trim(Auth::user()->name . ' realizou a finalização do processo de código '. $data->id . ' [SAC]' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $data));
                $data->delete();
                return redirect()->route('default.process_stage_five.index');
            }
        }

        return redirect()->route('default.process_stage_five.index');
    }

    public function sendSolvedTelegramMessage($id) {
        $process = Process::find($id);
        $address = Address::find($process->address()->get()->first()->id)->cities_id;

        $data = [
            "user_name" => Auth::user()->name,
            "process_id" => $process->id,
            "customer_name" => Customer::find($process->customer()->get()->first()->id)->name,
            "customer_city" => City::find($address)->name,
            "process_update" => $process->updated_at
        ];
        Notification::route('telegram', '-458942798')
            ->notify(new SolvedNotification($data));
        return redirect()->route('default.process_stage_five.index');
    }

    public function search(Request $request) {
        if(Gate::denies('list-process-stage-five')){
            return view('403');
        }

        $process = DB::table('processes')->where('processes.stage', '=', 4)
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

        return view('default.process_stage_five.index')->with([
            'response' => $process,
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }
}

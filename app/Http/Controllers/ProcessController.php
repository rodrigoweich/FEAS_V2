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
use App\ProcessLog;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ProcessStageFourController;

class ProcessController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function next_stage($id)
    {
        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                $customer = Customer::find($process->customer()->get()->first()->id);
                if ($process->stage == 0) {
                    $comment = new ProcessLog;
                    $comment->description = 'Ação padrão do sistema.';
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 0;
                    $comment->next_stage = 1;
                    $process->process_logs()->save($comment);
                    $process->stage = 1;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' avançou o processo de código '. $process->id . ' para o próximo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));
                    return redirect()->route('default.process_stage_one.index');
                } else if ($process->stage == 1 && $customer->service_boxes_id != null) {
                    $comment = new ProcessLog;
                    $comment->description = 'Ação padrão do sistema.';
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 1;
                    $comment->next_stage = 2;
                    $process->process_logs()->save($comment);
                    $process->stage = 2;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' avançou o processo de código '. $process->id . ' para o próximo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));
                    return redirect()->route('default.process_stage_two.index');
                } else if ($process->stage == 2 && $process->responsible_id != null) {
                    $comment = new ProcessLog;
                    $comment->description = 'Ação padrão do sistema.';
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 2;
                    $comment->next_stage = 3;
                    $process->process_logs()->save($comment);
                    $process->stage = 3;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' avançou o processo de código '. $process->id . ' para o próximo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));
                    return redirect()->route('default.process_stage_three.index');
                } else if ($process->stage == 3 && $process->route != null) {
                    $comment = new ProcessLog;
                    $comment->description = 'Ação padrão do sistema.';
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 3;
                    $comment->next_stage = 4;
                    $process->process_logs()->save($comment);
                    $process->stage = 4;
                    Log::info(trim(Auth::user()->name . ' avançou o processo de código '. $process->id . ' para o próximo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process));
                    ProcessStageFourController::sendTelegramMessage($process->id);
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_four.index');
                }
            }
        }
        return redirect()->route('default.process_stage_one.index');
    }

    public function previous_stage(Request $request, $id)
    {
        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                $customer = Customer::find($process->customer()->get()->first()->id);
                if ($process->stage == 1) {
                    $comment = new ProcessLog;
                    $comment->description = $request->comments;
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 1;
                    $comment->next_stage = 0;
                    $process->process_logs()->save($comment);
                    $process->stage = 0;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' voltou o processo de código '. $process->id . ' para o antigo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process . PHP_EOL . PHP_EOL . ' Motivo: ' . $comment->description));
                    return redirect()->route('default.process_stage_two.index');
                } else if ($process->stage == 2) {
                    $comment = new ProcessLog;
                    $comment->description = $request->comments;
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 2;
                    $comment->next_stage = 1;
                    $process->process_logs()->save($comment);
                    $process->stage = 1;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' voltou o processo de código '. $process->id . ' para o antigo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process . PHP_EOL . PHP_EOL . ' Motivo: ' . $comment->description));
                    return redirect()->route('default.process_stage_three.index');
                } else if ($process->stage == 3) {
                    $comment = new ProcessLog;
                    $comment->description = $request->comments;
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 3;
                    $comment->next_stage = 2;
                    $process->process_logs()->save($comment);
                    $process->stage = 2;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' voltou o processo de código '. $process->id . ' para o antigo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process . PHP_EOL . PHP_EOL . ' Motivo: ' . $comment->description));
                    return redirect()->route('default.process_stage_four.index');
                } else if ($process->stage == 4) {
                    $comment = new ProcessLog;
                    $comment->description = $request->comments;
                    $comment->processes_id = $process;
                    $comment->stage = $process->stage;
                    $comment->users_id = Auth::user()->id;
                    $comment->current_stage = 4;
                    $comment->next_stage = 3;
                    $process->process_logs()->save($comment);
                    $process->stage = 3;
                    $customer->process()->save($process);
                    Log::info(trim(Auth::user()->name . ' voltou o processo de código '. $process->id . ' para o antigo estágio.' . PHP_EOL . 'Informações adicionais' . PHP_EOL . $process . PHP_EOL . PHP_EOL . ' Motivo: ' . $comment->description));
                    return redirect()->route('default.process_stage_five.index');
                }
            }
        }
        return redirect()->route('default.process_stage_one.index');
    }

    public function get_log(Request $request) {

        $response = DB::table('processes')
        ->leftjoin('process_logs', 'processes.id', '=', 'process_logs.processes_id')
        ->leftjoin('users', 'process_logs.users_id', '=', 'users.id')
        ->where('processes.id', '=', $request->id)
        ->whereNotNull('process_logs.id')
        ->select('process_logs.description', 'process_logs.created_at', 'process_logs.stage', 'process_logs.current_stage', 'process_logs.next_stage', 'users.name')->get();

        return $response;
    }

    public function index_history()
    {
        if(Gate::denies('list-process-history')){
            return view('403');
        }
        
        $users = User::all();
        $customers = Customer::all();
        return view('default.process_history.index')->with([
            'response' => Process::orderBy('id', 'desc')->where('users_id', Auth::user()->id)->withTrashed()->paginate(15),
            'user' => $users,
            'customer' => $customers
        ]);
    }

    public function history_show($id)
    {
        if(Gate::denies('list-process-history')){
            return view('403');
        }

        if(isset($id)) {
            $response = Customer::find($id);
            if(!$response) {
                return view('404');
            } else {
                $city = City::all();
                $process = Process::where('customers_id', $response->id)->withTrashed()->get()->first();
                //return dd($process);
                $photos = json_decode(ProcessPhotos::where('processes_id', $process->id)->get(), true);
                if($photos) {
                    $photos_name = [];
                    foreach($photos as $a) {
                        foreach(json_decode($a["name"], true) as $b) {
                            array_push($photos_name, $b);
                        }
                    }
                    $photos = $photos_name;
                }

                return view('default.process_history.show')->with([
                    'response' => $response,
                    'cities' => $city,
                    "photos" => $photos
                ]);
            }
        }
        return redirect()->route('default.customers.index');
    }

    public function index_list()
    {
        if(Gate::denies('list-general-process')){
            return view('403');
        }
        
        $users = User::all();
        $customers = Customer::all();
        return view('default.process_list.index')->with([
            'response' => Process::orderBy('id', 'desc')->withTrashed()->paginate(15),
            'user' => $users,
            'customer' => $customers
        ]);
    }

    public function list_show($id)
    {
        if(Gate::denies('list-general-process')){
            return view('403');
        }

        $response = Process::withTrashed()->find($id);
        if($response->customer()->get()->first()->service_boxes_id != null) {
            $selectedBox = ServiceBox::where('id', $response->customer()->get()->first()->service_boxes_id)->first();
        } else {
            $selectedBox = null;
        }
        if($response->cables_id != null) {
            $cable = Cable::where('id', $response->cables_id)->first();
        } else {
            $cable = null;
        }
        if($response->route != null) {
            $route = json_decode($response->route, true)["i"];
        } else {
            $route = null;
        }
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
        
        return view('default.process_list.show')->with([
            'response' => $response,
            "cities" => $city,
            "selectedBox" => $selectedBox,
            "route" => $route,
            "cable" => $cable,
            "photos" => $photos
        ]);
    }

    public function list_search(Request $request) {
        if(Gate::denies('list-general-process')){
            return view('403');
        }

        $process = DB::table('processes')
        ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
        ->leftjoin('users', 'processes.users_id', '=', 'users.id')
        ->leftjoin('users as tech', 'processes.users_id_finished', '=', 'tech.id')
        ->where(function ($query) use ($request){
            $query->where('customers.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('users.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('tech.name', 'like', '%'.$request->dataToSearch.'%');
        })
        ->select('processes.id', 'processes.customers_id', 'processes.users_id', 'processes.created_at', 'customers.name', 'cities.name', 'users.name', 'addresses.cities_id', 'processes.responsible_id', 'processes.route', 'processes.stage', 'processes.users_id_finished')
        ->orderBy('processes.id', 'DESC')
        ->paginate(15);

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        return view('default.process_list.index')->with([
            'response' => $process,
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

    public function history_search(Request $request) {
        if(Gate::denies('list-process-history')){
            return view('403');
        }

        $process = DB::table('processes')
        ->leftjoin('customers', 'processes.customers_id', '=', 'customers.id')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
        ->leftjoin('users', 'processes.users_id', '=', 'users.id')
        ->leftjoin('users as tech', 'processes.users_id_finished', '=', 'tech.id')
        ->where(function ($query) use ($request){
            $query->whereDate('processes.created_at', $request->dataToSearch)
            ->orWhere('customers.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('tech.name', 'like', '%'.$request->dataToSearch.'%');
        })
        ->select('processes.id', 'processes.customers_id', 'processes.users_id', 'processes.created_at', 'customers.name', 'cities.name', 'users.name', 'addresses.cities_id', 'processes.responsible_id', 'processes.route', 'processes.stage', 'processes.users_id_finished')
        ->orderBy('processes.id', 'DESC')
        ->paginate(15);

        $cities = City::all();
        $users = User::all();
        $customers = Customer::all();
        $addresses = Address::all();

        return view('default.process_history.index')->with([
            'response' => $process,
            'user' => $users,
            'customer' => $customers,
            'address' => $addresses,
            'city' => $cities
        ]);
    }

}

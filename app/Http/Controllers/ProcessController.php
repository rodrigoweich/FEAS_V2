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
                    $process->stage = 1;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_one.index');
                } else if ($process->stage == 1) {
                    $process->stage = 2;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_two.index');
                } else if ($process->stage == 2) {
                    $process->stage = 3;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_three.index');
                } else if ($process->stage == 3) {
                    $process->stage = 4;
                    ProcessStageFourController::sendTelegramMessage($process->id);
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_four.index');
                }
            }
        }
        return redirect()->route('default.process_stage_one.index');
    }

    public function previous_stage($id)
    {
        if(isset($id)) {
            $process = Process::find($id);
            if(!$process) {
                return view('404');
            } else {
                $customer = Customer::find($process->customer()->get()->first()->id);
                if ($process->stage == 1) {
                    $process->stage = 0;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_two.index');
                } else if ($process->stage == 2) {
                    $process->stage = 1;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_three.index');
                } else if ($process->stage == 3) {
                    $process->stage = 2;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_four.index');
                } else if ($process->stage == 4) {
                    $process->stage = 3;
                    $customer->process()->save($process);
                    return redirect()->route('default.process_stage_five.index');
                }
            }
        }
        return redirect()->route('default.process_stage_one.index');
    }

    public function index_history()
    {
        if(Gate::denies('list-process-history')){
            return view('403');
        }
        
        $users = User::all();
        return view('default.process_history.index')->with([
            'response' => Process::orderBy('id', 'desc')->where('users_id', Auth::user()->id)->withTrashed()->paginate(15),
            'user' => $users
        ]);
    }

    public function index_list()
    {
        if(Gate::denies('list-general-process')){
            return view('403');
        }
        
        $users = User::all();
        return view('default.process_list.index')->with([
            'response' => Process::orderBy('id', 'desc')->withTrashed()->paginate(15),
            'user' => $users
        ]);
    }

}

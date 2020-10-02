<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Customer;
use App\ServiceBox;
use App\City;
use App\Process;
use App\ProcessPhotos;

class CustomerController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('list-customers')){
            return view('403');
        }
     
        $customers = Customer::paginate(15);
        $sbox = ServiceBox::all();
        return view('default.customers.index')->with([
            'response' => $customers,
            'box' => $sbox
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('update-process-stage-one')){
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

                return view('default.customers.show')->with([
                    'response' => $response,
                    'cities' => $city,
                    "photos" => $photos
                ]);
            }
        }
        return redirect()->route('default.customers.index');
    }
}

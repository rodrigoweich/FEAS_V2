<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Customer;
use App\ServiceBox;
use App\Process;
use App\ProcessPhotos;
use App\Http\Requests\CityRequest;
use DB;
use App\City;

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
     
        $customers = DB::table('customers')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
        ->select('customers.id as customer_id',
                    'customers.surname as customer_surname',
                    'customers.phone as customer_phone',
                    'customers.m_icon as customer_icon',
                    'customers.contract_number as customer_contract',
                    'customers.name as customer_name',
                    'cities.name as city_name')
        ->orderBy('customer_id', 'DESC')
        ->paginate(15);

        
        return view('default.customers.index')->with([
            'response' => $customers
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

    public function search(Request $request)
    {
        if(Gate::denies('list-customers')){
            return view('403');
        }

        $customers = DB::table('customers')
        ->leftjoin('addresses', 'customers.id', '=', 'addresses.customers_id')
        ->leftjoin('cities', 'addresses.cities_id', '=', 'cities.id')
        ->where(function ($query) use ($request){
            $query->where('cities.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('customers.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('customers.surname', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('customers.phone', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('customers.contract_number', '=', $request->dataToSearch);
        })->select('customers.id as customer_id',
                    'customers.surname as customer_surname',
                    'customers.phone as customer_phone',
                    'customers.m_icon as customer_icon',
                    'customers.contract_number as customer_contract',
                    'customers.name as customer_name',
                    'cities.name as city_name')
        ->orderBy('customer_id', 'DESC')
        ->paginate(15);
     
        return view('default.customers.index')->with([
            'response' => $customers
        ]);
    }
}

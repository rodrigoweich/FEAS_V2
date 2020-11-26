<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\ServiceBox;
use App\City;
use DB;
use App\Customer;
use App\Http\Requests\ServiceBoxRequest;

use Illuminate\Support\Facades\Log;
use Auth;

class ServiceBoxController extends Controller
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
        if(Gate::denies('list-service_boxes')){
            return view('403');
        }
        
        $sb = DB::table('service_boxes')
        ->leftjoin('cities', 'service_boxes.cities_id', '=', 'cities.id')
        ->select('service_boxes.id', 'service_boxes.name as sb_name', 'service_boxes.description', 'service_boxes.amount', 'service_boxes.busy', 'service_boxes.cities_id', 'cities.name as ct_name')
        ->orderBy('service_boxes.id', 'desc')
        ->paginate(15);

        $teste = [];
        foreach($sb as $c) {
            $teste += array($c->id => HasController::hasCustomersLinkedToBox($c->id));
        }
     
        $cities = City::all();
        return view('default.service_boxes.index')->with([
            'response' => $sb,
            'city' => $cities,
            'hasProcesses' => $teste
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-service_boxes')){
            return view('403');
        }
     
        $city = City::all();
        return view('default.service_boxes.create')->with([
            "cities" => $city
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceBoxRequest $request)
    {
        if(Gate::denies('create-service_boxes')){
            return view('403');
        }

        $service_box = new ServiceBox;
        $service_box->name = $request->name;
        $service_box->cities_id = $request->city;
        $service_box->m_lat = $request->lat;
        $service_box->m_lng = $request->lng;
        $service_box->description = $request->description;
        $service_box->amount = $request->amount;
        $service_box->busy = $request->busy;
        $service_box->save();
        Log::info(trim(Auth::user()->name . ' criou a caixa '. $service_box->name . PHP_EOL . 'Informações adicionais' . PHP_EOL . $service_box));
        return redirect()->route('default.boxes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('update-service_boxes')){
            return view('403');
        }

        if(isset($id)) {
            $data = ServiceBox::find($id);
            if(!$data) {
                return view('404');
            } else {
                $city = City::all();
                return view('default.service_boxes.edit')->with([
                    'data' => $data,
                    "cities" => $city
                ]);
            }
        }

        return redirect()->route('default.boxes.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceBoxRequest $request, $id)
    {
        if(Gate::denies('update-service_boxes')){
            return view('403');
        }

        if(isset($id)) {
            $service_box = ServiceBox::find($id);
            $old_service_box = ServiceBox::find($id);
            if(!$service_box) {
                return view('404');
            } else {
                $service_box->name = $request->name;
                $service_box->cities_id = $request->city;
                $service_box->m_lat = $request->lat;
                $service_box->m_lng = $request->lng;
                $service_box->description = $request->description;
                $service_box->amount = $request->amount;
                $service_box->busy = $request->busy;
                $service_box->save();
                $service_box = ServiceBox::find($id);

                Log::info(trim(Auth::user()->name . ' editou a caixa '. $service_box->name . PHP_EOL . 'Comparação nas linhas abaixo [ \'<\' = antes / \'>\' = depois ]' . PHP_EOL . '< ' . $old_service_box . PHP_EOL . '> ' . $service_box));
                return redirect()->route('default.boxes.index');
            }
        }
        
        return redirect()->route('default.boxes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-service_boxes')){
            return view('403');
        }

        $hasCustomers = Customer::where('service_boxes_id', $id)->count();
        if($hasCustomers > 0) {
            \Session::flash('message', 'Essa caixa não pode ser deletada pois existem outros elementos vinculados a ela.');
            return redirect()->route('default.boxes.index');
        }

        if(isset($id)) {
            $data = ServiceBox::find($id);
            if(!$data) {
                return view('404');
            } else {
                Log::info(trim(Auth::user()->name . ' deletou a caixa '. $data->name . PHP_EOL . 'Informações adicionais' . PHP_EOL . $data));
                $data->delete();
                return redirect()->route('default.boxes.index');
            }
        }

        return redirect()->route('default.boxes.index');
    }

    public function search(Request $request)
    {
        if(Gate::denies('list-service_boxes')){
            return view('403');
        }

        $sb = DB::table('service_boxes')
        ->leftjoin('cities', 'service_boxes.cities_id', '=', 'cities.id')
        ->where(function ($query) use ($request) {
            $query->where('service_boxes.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('service_boxes.description', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('cities.name', 'like', '%'.$request->dataToSearch.'%');
        })->select('service_boxes.id', 'service_boxes.name as sb_name', 'service_boxes.description', 'service_boxes.amount', 'service_boxes.busy', 'service_boxes.cities_id', 'cities.name as ct_name')
        ->orderBy('service_boxes.id', 'desc')
        ->paginate(15);

        $teste = [];
        foreach($sb as $c) {
            $teste += array($c->id => HasController::hasCustomersLinkedToBox($c->id));
        }
     
        $cities = City::all();
        return view('default.service_boxes.index')->with([
            'response' => $sb,
            'city' => $cities,
            'hasProcesses' => $teste
        ]);
    }

    public function getBoxCustomers(Request $request) {
        $box = ServiceBox::find($request->input('id'));
        $customers = Customer::where('service_boxes_id', '=', $box->id)->get();
        return $customers;
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\City;
use App\State;
use App\ServiceBox;
use App\Http\Requests\CityRequest;
use DB;

use Illuminate\Support\Facades\Log;
use Auth;

class CityController extends Controller
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
        if(Gate::denies('list-cities')){
            return view('403');
        }
     
        $cities = City::orderBy('cities.id', 'DESC')->paginate(15);

        $teste = [];
        foreach($cities as $c) {
            $teste += array($c->id => HasController::hasProcessesLinkedToTheCity($c->id));
        }
        $box = [];
        foreach($cities as $c) {
            $box += array($c->id => HasController::hasBoxesInTheCity($c->id));
        }

        $states = State::all();
        return view('admin.cities.index')->with([
            'response' => $cities,
            'state' => $states,
            'hasProcesses' => $teste,
            'hasBoxes' => $box
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-cities')){
            return view('403');
        }

        $states = State::all();
        return view('admin.cities.create')->with([
            'states' => $states
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        if(Gate::denies('create-cities')){
            return view('403');
        }

        $city = new City;
        $city->name = $request->name;
        $city->m_lat = $request->lat;
        $city->m_lng = $request->lng;
        $city->m_zoom = $request->zoom;
        $city->states_id = $request->state;
        if ($request->inputshortcut == 'on') {
            $city->shortcut = 1;
        } else {
            $city->shortcut = 0;
        }
        $city->save();
        Log::info(trim(Auth::user()->name . ' criou a cidade '. $city->name . PHP_EOL . 'Informações adicionais' . PHP_EOL . $city));
        return redirect()->route('admin.cities.index');
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
        if(Gate::denies('update-cities')){
            return view('403');
        }

        $city = City::find($id);
        $states = State::all();

        if(!$city) {
            return view('404');
        } else {
            return view('admin.cities.edit')->with([
                'city' => $city,
                'states' => $states
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, $id)
    {
        if(Gate::denies('update-cities')){
            return view('403');
        }

        if(isset($id)) {
            $city = City::find($id);
            $old_city = City::find($id);
            if(!$city) {
                return view('404');
            } else {
                $city->name = $request->name;
                $city->m_lat = $request->lat;
                $city->m_lng = $request->lng;
                $city->m_zoom = $request->zoom;
                $city->states_id = $request->state;
                if ($request->inputshortcut == 'on') {
                    $city->shortcut = 1;
                } else {
                    $city->shortcut = 0;
                }
                $city->save();
                $city = City::find($id);

                Log::info(trim(Auth::user()->name . ' editou a cidade '. $city->name . PHP_EOL . 'Comparação nas linhas abaixo [ \'<\' = antes / \'>\' = depois ]' . PHP_EOL . '< ' . $old_city . PHP_EOL . '> ' . $city));
                return redirect()->route('admin.cities.index');
            }
        }
        
        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-cities')){
            return view('403');
        }

        $hasBoxes = ServiceBox::where('cities_id', '=', $id)->count();
        $hasProcesses = City::find($id)->addresses()->count();
        if($hasProcesses > 0 || $hasBoxes > 0) {
            \Session::flash('message', 'Essa cidade não pode ser deletada pois existem outros elementos vinculados a ela.');
            return redirect()->route('admin.cities.index');
        }

        $city = City::find($id);

        if(isset($id)) {
            if(!$city) {
                return view('404');
            } else {
                Log::info(trim(Auth::user()->name . ' deletou a cidade '. $city->name . PHP_EOL . 'Informações adicionais' . PHP_EOL . $city));
                $city->delete();
                return redirect()->route('admin.cities.index');
            }
        }

        return redirect()->route('admin.cities.index');
    }

    public function search(Request $request)
    {
        if(Gate::denies('list-cities')){
            return view('403');
        }

        $cities = DB::table('cities')
        ->leftjoin('states', 'cities.states_id', '=', 'states.id')
        ->where(function ($query) use ($request){
            $query->where('cities.name', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('states.name', 'like', '%'.$request->dataToSearch.'%');
        })->select('cities.id', 'cities.name', 'cities.states_id', 'cities.m_lat', 'cities.m_lng', 'cities.m_zoom', 'cities.shortcut', 'states.name')
        ->orderBy('cities.id', 'DESC')
        ->paginate(15);

        $teste = [];
        foreach($cities as $c) {
            $teste += array($c->id => HasController::hasProcessesLinkedToTheCity($c->id));
        }

        $states = State::all();
        return view('admin.cities.index')->with([
            'response' => $cities,
            'state' => $states,
            'hasProcesses' => $teste
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\City;
use App\State;

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
     
        $cities = City::paginate(15);

        $teste = [];
        foreach($cities as $c) {
            $teste += array($c->id => HasController::hasProcessesLinkedToTheCity($c->id));
        }

        return view('admin.cities.index')->with([
            'response' => $cities,
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
    public function store(Request $request)
    {
        if(Gate::denies('create-cities')){
            return view('403');
        }

        $rules = [
            'name' => 'required|min:2|max:75',
        ];
        $messages = [
            'name.required' => "O nome da cidade não pode ficar em branco.",
            'name.min' => "O nome deve conter ao menos :min caracteres.",
            'name.max' => "O nome deve conter no máximo :max caracteres."
        ];
        $request->validate($rules, $messages);

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
    public function update(Request $request, $id)
    {
        if(Gate::denies('update-cities')){
            return view('403');
        }

        $rules = [
            'name' => 'required|min:2|max:75',
        ];
        $messages = [
            'name.required' => "O nome da cidade não pode ficar em branco.",
            'name.min' => "O nome deve conter ao menos :min caracteres.",
            'name.max' => "O nome deve conter no máximo :max caracteres."
        ];
        $request->validate($rules, $messages);

        $city = City::find($id);
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

        $city = City::find($id);

        if(isset($id)) {
            if(!$city) {
                return view('404');
            } else {
                $city->delete();
                return redirect()->route('admin.cities.index');
            }
        }

        return redirect()->route('admin.cities.index');
    }

    public function search(Request $request)
    {
        $cities = City::where('name','like', '%'.$request->dataToSearch.'%')->paginate(15);
        return view('admin.cities.index')->with([
            'response' => $cities
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\ServiceBox;
use App\City;

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
     
        $sb = ServiceBox::paginate(15);
        return view('default.service_boxes.index')->with([
            'response' => $sb
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
    public function store(Request $request)
    {
        if(Gate::denies('create-service_boxes')){
            return view('403');
        }

        $service_box = new ServiceBox;
        $service_box->name = $request->name;
        $service_box->cities_id = $request->city;
        $service_box->m_lat = $request->lat;
        $service_box->m_lng = $request->lng;
        $service_box->save();
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
    public function update(Request $request, $id)
    {
        if(Gate::denies('update-service_boxes')){
            return view('403');
        }

        if(isset($id)) {
            $service_box = ServiceBox::find($id);
            if(!$service_box) {
                return view('404');
            } else {
                $service_box->name = $request->name;
                $service_box->cities_id = $request->city;
                $service_box->m_lat = $request->lat;
                $service_box->m_lng = $request->lng;
                $service_box->save();
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

        if(isset($id)) {
            $data = ServiceBox::find($id);
            if(!$data) {
                return view('404');
            } else {
                $data->delete();
                return redirect()->route('default.boxes.index');
            }
        }

        return redirect()->route('default.boxes.index');
    }

    public function search(Request $request)
    {
        $data = ServiceBox::where('name','like', '%'.$request->dataToSearch.'%')->paginate(15);
        return view('default.service_boxes.index')->with([
            'response' => $data
        ]);
    }
}

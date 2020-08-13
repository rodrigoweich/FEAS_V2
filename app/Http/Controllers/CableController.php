<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Cable;

class CableController extends Controller
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
        if(Gate::denies('list-cables')){
            return view('403');
        }
     
        $cables = Cable::paginate(15);
        return view('default.cables.index')->with([
            'response' => $cables
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-cables')){
            return view('403');
        }

        return view('default.cables.create')->with([
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
        if(Gate::denies('create-cables')){
            return view('403');
        }

        $cable = new Cable;
        $cable->name = $request->name;
        $cable->color = $request->color;
        if($request->inputshortcut == "on") {
            $cable->dotted = 1;
        } else {
            $cable->dotted = 0;
        }
        $cable->dotted_repeat = $request->repeat;
        $cable->size = $request->size;
        $cable->save();
        return redirect()->route('default.cables.index');
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
        if(Gate::denies('update-cables')){
            return view('403');
        }

        if(isset($id)) {
            $cable = Cable::find($id);
            if(!$cable) {
                return view('404');
            } else {
                return view('default.cables.edit')->with([
                    'cable' => $cable
                ]);
            }
        }

        return redirect()->route('default.cables.index');
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
        if(Gate::denies('update-cables')){
            return view('403');
        }
        
        if(isset($id)) {
            $cable = Cable::find($id);
            if(!$cable) {
                return view('404');
            } else {
                $cable->name = $request->name;
                $cable->color = $request->color;
                if($request->inputshortcut == "on") {
                    $cable->dotted = 1;
                } else {
                    $cable->dotted = 0;
                }
                $cable->dotted_repeat = $request->repeat;
                $cable->size = $request->size;
                $cable->save();
                return redirect()->route('default.cables.index');
            }
        }
        
        return redirect()->route('default.cables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-cables')){
            return view('403');
        }

        if(isset($id)) {
            $data = Cable::find($id);
            if(!$data) {
                return view('404');
            } else {
                $data->delete();
                return redirect()->route('default.cables.index');
            }
        }

        return redirect()->route('default.cables.index');
    }

    public function search(Request $request)
    {
        $data = Cable::where('name','like', '%'.$request->dataToSearch.'%')->paginate(15);
        return view('default.cables.index')->with([
            'response' => $data
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\State;

class StateController extends Controller
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
        if(Gate::denies('list-states')){
            return view('403');
        }
     
        $states = State::paginate(15);
        return view('admin.states.index')->with([
            'response' => $states
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-states')){
            return view('403');
        }

        return view('admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::denies('create-states')){
            return view('403');
        }

        $rules = [
            'name' => 'required|min:1|max:50',
            'uf' => 'required|min:1|max:2'
        ];
        $messages = [
            "name.required" => "if the name is blank.",
            "name.min" => "if the name contains at least :min characters",
            "name.max" => "if the name contains a maximum of :max characters",
            "name.required" => "if the uf is blank.",
            "name.min" => "if the uf contains at least :min characters",
            "name.max" => "if the uf contains a maximum of :max characters",
        ];
        $request->validate($rules, $messages);

        $state = new State;
        $state->name = $request->name;
        $state->uf = $request->uf;
        $state->save();
        return redirect()->route('admin.states.index');
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
        if(Gate::denies('create-states')){
            return view('403');
        }

        $state = State::find($id);
        return view('admin.states.edit')->with([
            'state' => $state
        ]);
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
        if(Gate::denies('create-states')){
            return view('403');
        }

        $rules = [
            'name' => 'required|min:1|max:50',
            'uf' => 'required|min:1|max:2'
        ];
        $messages = [
            "name.required" => "if the name is blank.",
            "name.min" => "if the name contains at least :min characters",
            "name.max" => "if the name contains a maximum of :max characters",
            "name.required" => "if the uf is blank.",
            "name.min" => "if the uf contains at least :min characters",
            "name.max" => "if the uf contains a maximum of :max characters",
        ];
        $request->validate($rules, $messages);

        $state = State::find($id);
        $state->name = $request->name;
        $state->uf = $request->uf;
        $state->save();
        return redirect()->route('admin.states.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('update-users')){
            return view('403');
        }

        $state = State::find($id);
        if(isset($state)) {
            $state->delete();
            return redirect()->route('admin.states.index');
        }
        return redirect()->route('admin.states.index');
    }

    public function search(Request $request)
    {
        $states = State::where('name','like', '%'.$request->dataToSearch.'%')->paginate(15);
        return view('admin.states.index')->with([
            "response" => $states
        ]);
    }
}

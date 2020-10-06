<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\Rule;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
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
        if(Gate::denies('list-roles')){
            return view('403');
        }

        $roles = Role::paginate(15);
     
        $teste = [];
        foreach($roles as $c) {
            $teste += array($c->id => HasController::hasUsersLinkedToTheRole($c->id));
        }
     
        return view('admin.roles.index')->with([
            'roles' => $roles,
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
        if(Gate::denies('create-roles')){
            return view('403');
        }

        $rules = Rule::all();
        return view('admin.roles.create')->with([
            'rules' => $rules
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if(Gate::denies('create-roles')){
            return view('403');
        }

        $role = new Role();
        $role->name = $request->name;
        $role->save();
        $role->rules()->sync($request->rules);
        $role->save();
        return redirect()->route('admin.roles.index');
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
        if(Gate::denies('update-roles')){
            return view('403');
        }

        $role = Role::find($id);
        if($role->unalterable === 1) {
            return redirect()->route('admin.roles.index');
        }
        $rules = Rule::all();
        return view('admin.roles.edit')->with([
            'role' => $role,
            'rules' => $rules
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        if(Gate::denies('update-roles')){
            return view('403');
        }

        $role = Role::find($id);
        $role->name = $request->name;
        $role->save();
        $role->rules()->sync($request->rules);
        $role->save();
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-roles')){
            return view('403');
        }

        $role = Role::find($id);
        if($role->unalterable === 1) {
            return redirect()->route('admin.roles.index');
        }
        if($role->users()->where('role_id', $role->id)->count() === 0){
            DB::table('role_user')->where('role_id', $role->id)->delete();
            $role->rules()->detach();
            $role->delete();
            return redirect()->route('admin.roles.index');
        }
    }

    public function search(Request $request)
    {
        if(Gate::denies('list-roles')){
            return view('403');
        }

        $roles = Role::where('name','like', '%'.$request->dataToSearch.'%')->paginate(15);
     
        $teste = [];
        foreach($roles as $c) {
            $teste += array($c->id => HasController::hasUsersLinkedToTheRole($c->id));
        }
     
        return view('admin.roles.index')->with([
            'roles' => $roles,
            'hasProcesses' => $teste
        ]);
    }
}

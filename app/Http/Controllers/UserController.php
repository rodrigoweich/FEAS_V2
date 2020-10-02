<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rule;
use App\Role;

use App\Http\Requests\UserRequest;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
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
        if(Gate::denies('list-users')){
            return view('403');
        }
     
        $users = User::paginate(15);
        return view('admin.users.index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-users')){
            return view('403');
        }

        $rules = Role::all();
        return view('admin.users.create')->with([
            'rules' => $rules
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(Gate::denies('create-users')){
            return view('403');
        }
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->sync($request->rules);
        $user->save();
        return redirect()->route('admin.users.index');
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
        if(Gate::denies('update-users')){
            return view('403');
        }

        $user = User::find($id);
        if($user->unalterable === 1) {
            return redirect()->route('admin.users.index');
        }
        $rules = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
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
    public function update(UserRequest $request, $id)
    {
        if(Gate::denies('update-users')){
            return view('403');
        }

        $user = User::find($id);
        $user->roles()->sync($request->rules);
        $user->name = $request->name;
        if(isset($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-users')){
            return view('403');
        }

        $user = User::find($id);
        if(empty($user))
        {
            return view('404');
        }
        if($user->unalterable === 1) {
            return redirect()->route('admin.users.index');
        }
        Storage::deleteDirectory('avatars/'.$user->id);
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index');
    }

    public function search(Request $request)
    {
        $users = User::where('name','like', '%'.$request->dataToSearch.'%')->paginate(15);
        return view('admin.users.index')->with([
            "users" => $users,
        ]);
    }

    public function showProfile($id)
    {
        $user = User::find($id);
        return view('users.profile')->with([
            "user" => $user
        ]);
    }

    public function updateProfile(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        if(isset($request->avatar_image)) {
            //Storage::delete($user->avatar);
            Storage::deleteDirectory('avatars/'.$user->id);//
            $path = $request->file('avatar_image')->store('avatars/'.$user->id);
            $user->avatar = $path;
        }
        $user->name = $request->name;
        if(isset($request->currentPw) && isset($request->newPw) && isset($request->confirmNewPw)) {
            if (Hash::check($request->currentPw, $user->password)) {
                if($request->confirmNewPw == $request->newPw) {
                    $user->password = Hash::make($request->newPw);
                }
            }               
        }
        $user->save();
        return redirect()->route('users.profile', $user);
    }
}

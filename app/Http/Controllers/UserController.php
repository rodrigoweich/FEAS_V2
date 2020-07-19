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
    public function store(Request $request)
    {
        if(Gate::denies('create-users')){
            return view('403');
        }

        $rules = [
            'name' => 'required|min:3|max:50',
            'email' => 'required|unique:users|min:3|max:50',
            'password' => 'required|min:8'
        ];
        $messages = [
            "name.required" => "O nome do usuário não pode ficar em branco.",
            "name.min" => "O nome deve conter ao menos :min caracteres.",
            "name.max" => "O nome deve conter no máximo :max caracteres.",
            "email.required" => "O email do usuário não pode ficar em branco.",
            "email.unique" => "Este email já existe em nossa base de dados e não pode ser alterado.",
            "email.min" => "O email deve conter ao menos :min caracteres.",
            "email.max" => "O email deve conter no máximo :max caracteres.",
            "password.required" => "A senha do usuário não pode ficar em branco.",
            "password.min" => "A senha deve conter pelo menos :min caracteres."
        ];
        $request->validate($rules, $messages);
        
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
    public function update(Request $request, $id)
    {
        if(Gate::denies('update-users')){
            return view('403');
        }

        if(isset($request->password)) {
            $rules = [
                'name' => 'required|min:3|max:50',
                'password' => 'required|min:8'
            ];
            $messages = [
                "name.required" => "O nome do usuário não pode ficar em branco.",
                "name.min" => "O nome deve conter ao menos :min caracteres.",
                "name.max" => "O nome deve conter no máximo :max caracteres.",
                "password.required" => "A senha do usuário não pode ficar em branco.",
                "password.min" => "A senha deve conter pelo menos :min caracteres."
            ];
        } else {
            $rules = [
                'name' => 'required|min:3|max:50',
            ];
            $messages = [
                "name.required" => "O nome do usuário não pode ficar em branco.",
                "name.min" => "O nome deve conter ao menos :min caracteres.",
                "name.max" => "O nome deve conter no máximo :max caracteres.",
            ];
        }
        $request->validate($rules, $messages);

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

    public function updateProfile(Request $request, $id)
    {
        if(isset($request->newPw)) {
            $rules = [
                'name' => 'required|min:3|max:50',
                'currentPw' => 'required',
                'newPw' => 'required|min:8',
                'confirmNewPw' => 'required|min:8|same:newPw',
                'avatar_image' => 'file|mimes:jpg,jpeg,png,bmp'
            ];
            $messages = [
                "name.required" => "O nome do usuário está em branco.",
                "name.min" => "O nome contém pelo menos :min caracteres.",
                "name.max" => "O nome contém no máximo :max caracteres.",
                "avatar_image.size" => "A imagem tem no máximo :size kbs",
                "avatar_image.mimes" => "O formato dor arquivo é .jpg, .jpeg, .png ou .bmp",
                "currentPw.required" => "A senha atual está em branco.",
                "newPw.required" => "A nova senha está em branco.",
                "newPw.min" => "A nova senha comtém pelo menos :min caracteres.",
                "confirmNewPw.required" => "A confirmação da senha está em branco.",
                "confirmNewPw.min" => "A confirmação da senha contém pelo menos :min caracteres.",
                "confirmNewPw.same" => "A confirmação da senha está correta."
            ];
        } else {
            $rules = [
                'name' => 'required|min:3|max:50',
                'avatar_image' => 'file|mimes:jpg,jpeg,png,bmp'
            ];
            $messages = [
                "name.required" => "O nome do usuário está em branco.",
                "name.min" => "O nome contém pelo menos :min caracteres.",
                "name.max" => "O nome contém no máximo :max caracteres.",
                "avatar_image.size" => "A imagem tem no máximo :size kbs",
                "avatar_image.mimes" => "O formato dor arquivo é .jpg, .jpeg, .png ou .bmp"
            ];
        }
        $request->validate($rules, $messages);

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

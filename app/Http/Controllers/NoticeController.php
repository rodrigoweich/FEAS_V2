<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Http\Requests\NoticeRequest;
use App\Notice;
use DB;
use App\User;

class NoticeController extends Controller
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
        if(Gate::denies('list-notices')){
            return view('403');
        }
     
        $notices = Notice::orderBy('id', 'DESC')->paginate(15);
        $users = User::all();
        return view('admin.notices.index')->with([
            'response' => $notices,
            'user' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-notices')){
            return view('403');
        }

        return view('admin.notices.create')->with([
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeRequest $request)
    {
        if(Gate::denies('create-notices')){
            return view('403');
        }

        $rules = [
            'title' => 'required|min:5|max:150',
            'description' => 'required|min:10|max:500'
        ];
        $messages = [
            "title.required" => "O título da notícia não pode ficar em branco.",
            "title.min" => "O título deve conter ao menos :min caracteres.",
            "title.max" => "O título deve conter no máximo :max caracteres.",
            "description.required" => "A descrição da notícia não pode ficar em branco.",
            "description.min" => "O descrição deve conter ao menos :min caracteres.",
            "description.max" => "O descrição deve conter no máximo :max caracteres.",
        ];
        $request->validate($rules, $messages);
        
        $notice = new Notice;
        $notice->title = $request->title;
        $notice->description = $request->description;
        if ($request->featured == "on") {
            $notice->featured = 1;
        } else {
            $notice->featured = 0;
        }
        if ($request->active == "on") {
            $notice->active = 1;
        } else {
            $notice->active = 0;
        }
        $notice->users_id = Auth::user()->id;
        $notice->save();
        return redirect()->route('admin.notices.index');
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
        if(Gate::denies('update-notices')){
            return view('403');
        }

        if(isset($id)) {
            $notice = Notice::find($id);
            if(!$notice) {
                return view('404');
            } else {
                return view('admin.notices.edit')->with([
                    'data' => $notice
                ]);
            }
        }

        return redirect()->route('admin.notices.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeRequest $request, $id)
    {
        if(Gate::denies('create-notices')){
            return view('403');
        }

        $rules = [
            'title' => 'required|min:5|max:150',
            'description' => 'required|min:10|max:500'
        ];
        $messages = [
            "title.required" => "O título da notícia não pode ficar em branco.",
            "title.min" => "O título deve conter ao menos :min caracteres.",
            "title.max" => "O título deve conter no máximo :max caracteres.",
            "description.required" => "A descrição da notícia não pode ficar em branco.",
            "description.min" => "O descrição deve conter ao menos :min caracteres.",
            "description.max" => "O descrição deve conter no máximo :max caracteres.",
        ];
        $request->validate($rules, $messages);
        
        if(isset($id)) {
            $notice = Notice::find($id);
            if(!$notice) {
                return view('404');
            } else {
                $notice->title = $request->title;
                $notice->description = $request->description;
                if ($request->featured == "on") {
                    $notice->featured = 1;
                } else {
                    $notice->featured = 0;
                }
                if ($request->active == "on") {
                    $notice->active = 1;
                } else {
                    $notice->active = 0;
                }
                $notice->users_id = Auth::user()->id;
                $notice->save();
                return redirect()->route('admin.notices.index');
            }
        }
        
        return redirect()->route('admin.notices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('delete-notices')){
            return view('403');
        }

        $data = Notice::find($id);

        if(isset($id)) {
            if(!$data) {
                return view('404');
            } else {
                $data->delete();
                return redirect()->route('admin.notices.index');
            }
        }

        return redirect()->route('admin.notices.index');
    }

    public function search(Request $request)
    {
        if(Gate::denies('list-notices')){
            return view('403');
        }

        $notices = DB::table('notices')
        ->leftjoin('users', 'notices.users_id', '=', 'users.id')
        ->where(function ($query) use ($request) {
            $query->whereDate('notices.pub_date_time', $request->dataToSearch)
            ->orWhere('notices.title', 'like', '%'.$request->dataToSearch.'%')
            ->orWhere('users.name', 'like', '%'.$request->dataToSearch.'%');
        })
        ->select('notices.id', 'notices.title', 'notices.pub_date_time', 'notices.featured', 'notices.active', 'notices.users_id')
        ->orderBy('notices.id', 'DESC')
        ->paginate(15);
     
        $users = User::all();
        return view('admin.notices.index')->with([
            'response' => $notices,
            'user' => $users
        ]);
    }
}

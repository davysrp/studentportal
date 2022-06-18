<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(['id', 'firstname','status','lastname','gender','phone', 'email']);

            return Datatables::of($users)
                ->addColumn('action', function ($user) {
                    return $this->actionButton($user,'admins.edit','admins.destroy','admins.show');
                })
                ->addColumn('status', function ($user) {
                    return $this->statusAttr($user->status);
                })
                ->editColumn('id', '{{$id}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rules = Role::pluck('name','id');
        return view('backend.users.create',compact('rules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user=User::create($request->all());
        $user->roles()->sync($request->role_id);
        return redirect()->back()->with(['success' => 'Recode save successful']);
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
        $user = User::find($id);
        if ($user)
            $rules = Role::pluck('name','id');
            return view(parent::viewPath().'users.edit',compact('user','rules'));

        abort(404);
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
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->roles()->sync($request->role_id);
        return redirect()->to(route('admins.index'))->with('success','User updated successful') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        if ($user)
            $user->delete();
            $user->roles()->detach();
        return redirect()->back()->with('success','User deleted successful') ;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuleRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RuleContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rules = Role::select(['id', 'name','slug']);

            return Datatables::of($rules)
                ->addColumn('action', function ($user) {
                    return $this->actionButton($user,'rules.edit','rules.destroy','rules.show');
                })
                ->editColumn('id', '{{$id}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.rules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.rules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuleRequest $request)
    {
        Role::create($request->all());
        return redirect()->back()->with('success', 'Rule save successful!');
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
        $rule = Role::find($id);
        return view('backend.rules.edit',compact('rule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RuleRequest $request, $id)
    {
        $rule = Role::find($id)->update($request->all());
        return redirect()->back()->with('success', 'Rule save successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rule = Role::destroy($id);
        return redirect()->back()->with('success', 'Rule delete successful!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\LabelValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rules = Label::select(['id', 'name']);

            return DataTables::of($rules)
                ->addColumn('action', function ($user) {
                    return $this->actionButton($user, 'labels.edit', 'labels.destroy', 'labels.show');
                })
                ->editColumn('id', '{{$id}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.labels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.labels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $label = Label::create([
            'name'=>$request->name[1]
        ]);

        $labelValueData = [];
        foreach ($request->code as $key => $value) {
            $labelValueData[] = [
                'language_id' => $request->language_id[$key],
                'label_id' => $label->id,
                'value' =>$request->name[$key],
                'created_at'=> DB::raw('CURRENT_TIMESTAMP'),
                'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            ];
        }
        LabelValue::insert($labelValueData);
        return redirect()->back()->with('success', 'Label save successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Label $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Label $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        $label = Label::find($label->id);
        return view('backend.labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateLabelRequest $request
     * @param \App\Models\Label $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {

        foreach ($request->code as $key => $value) {
            $value = LabelValue::where('language_id', $request->language_id[$key])->where('label_id', $label->id)->first();
           /* $value->update([
                'value' =>$request->name[$key],
                'updated_at'=> DB::raw('CURRENT_TIMESTAMP'),
            ]);*/
            $value->value = $request->name[$key];
            $value->save();

        }
        Label::find($label->id)->update([
            'name'=>$request->name[1]
        ]);
        return redirect()->to(route('labels.index'))->with('success', 'Label save successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Label $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        Label::destroy($label->id);
        return redirect()->to(route('labels.index'))->with('success', 'Label delete successful!');
    }
}

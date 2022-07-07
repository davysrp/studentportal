<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Http\Requests\StoreAttributeSetRequest;
use App\Http\Requests\UpdateAttributeSetRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AttributeSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $attribute = AttributeSet::select(['id','name']);

            return DataTables::of($attribute)
                ->addColumn('action', function ($model) {
                    return $this->actionButton($model,'attribute-sets.edit','attribute-sets.destroy','attribute-sets.show');
                })
                ->editColumn('id', '{{$id}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.attribute-sets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::all();
        return view('backend.attribute-sets.create',compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttributeSetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeSetRequest $request)
    {
        $attributeSet=AttributeSet::create($request->all());
        $attribute = Attribute::find($request->attributeIds);
        $attributeSet->attributes()->sync($attribute);
        return redirect()->back()->with('success', 'Attribute Set save successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeSet $attributeSet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeSet $attributeSet)
    {
        $attributes = Attribute::all();
        $attribute_set = AttributeSet::find($attributeSet->id);
        return view('backend.attribute-sets.edit',compact('attribute_set','attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttributeSetRequest  $request
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeSetRequest $request, AttributeSet $attributeSet)
    {
        $attributeSet = AttributeSet::find($attributeSet->id);
        $attributeSet->update($request->all());
        $attribute = Attribute::find($request->attributeIds);
        $attributeSet->attributes()->sync($attribute);
        return redirect()->back()->with('success', 'Attribute save successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeSet $attributeSet)
    {
        $attributeSet=AttributeSet::find($attributeSet->id);
        $attributeSet->delete();
        $attributeSet->attributes()->detach();
        return redirect()->back()->with('success', 'Attribute delete successful!');
    }
}

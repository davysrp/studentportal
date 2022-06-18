<?php

namespace App\Http\Controllers;

use App\Models\AttributeSet;
use App\Http\Requests\StoreAttributeSetRequest;
use App\Http\Requests\UpdateAttributeSetRequest;

class AttributeSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttributeSetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeSetRequest $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeSet $attributeSet)
    {
        //
    }
}

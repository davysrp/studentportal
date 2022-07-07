<?php

namespace App\Http\Controllers;

use App\Models\PostAttribute;
use App\Http\Requests\StorePostAttributeRequest;
use App\Http\Requests\UpdatePostAttributeRequest;

class PostAttributeController extends Controller
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
     * @param  \App\Http\Requests\StorePostAttributeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostAttributeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostAttribute  $postAttribute
     * @return \Illuminate\Http\Response
     */
    public function show(PostAttribute $postAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostAttribute  $postAttribute
     * @return \Illuminate\Http\Response
     */
    public function edit(PostAttribute $postAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostAttributeRequest  $request
     * @param  \App\Models\PostAttribute  $postAttribute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostAttributeRequest $request, PostAttribute $postAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostAttribute  $postAttribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostAttribute $postAttribute)
    {
        //
    }
}

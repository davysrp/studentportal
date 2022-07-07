<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\PostType;
use App\Http\Requests\StorePostTypeRequest;
use App\Http\Requests\UpdatePostTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rules = PostType::select(['id', 'name','slug','attribute_set_id']);

            return DataTables::of($rules)
                ->addColumn('action', function ($user) {
                    return $this->actionButton($user,'post-types.edit','post-types.destroy','post-types.show');
                })
                ->editColumn('id', '{{$id}}')
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.post-types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $attributeSet = AttributeSet::all()->pluck('name', 'id');
        return view('backend.post-types.create',compact('attributeSet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostTypeRequest $request)
    {
        PostType::create($request->all());
        return redirect()->back()->with('success', 'Post Type save successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function show(PostType $postType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function edit(PostType $postType)
    {
        $post_type = PostType::find($postType->id);
        $attributeSet = AttributeSet::all()->pluck('name', 'id');
        return view('backend.post-types.edit',compact('post_type','attributeSet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostTypeRequest  $request
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostTypeRequest $request, PostType $postType)
    {
        PostType::find($postType->id)->update($request->all());
        return redirect()->to(route('post-types.index'))->with('success', 'Post Type save successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostType $postType)
    {
        PostType::destroy($postType->id);
        return redirect()->to(route('post-types.index'))->with('success', 'Post Type delete successful!');
    }
}

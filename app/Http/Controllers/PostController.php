<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Language;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\PostAttribute;
use App\Models\PostType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $post = Post::select('posts.*');

            return DataTables::of($post)
                ->addColumn('action', function ($user) {
                    return $this->actionButton($user, 'posts.edit', 'posts.destroy', 'posts.show');
                })
                ->editColumn('id', '{{$id}}')
                ->escapeColumns([])
                ->make(true);
        }
        $postType = PostType::whereSlug($request->type)->first();

        return view('backend.posts.index', compact('postType'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $attributeSetId = $request->setId;
        $attribute = Attribute::whereHas('attributeSets', function ($sql) use ($request) {
            $sql->where('attribute_set_id', $request->setId);
        })->get();
        $languages = Language::orderBy('id', 'asc')->get();
        $postType = PostType::whereSlug($request->type)->first();
        $parent = Post::where('post_type_id', PostType::whereSlug($request->type)->first()->id)->pluck('name', 'id');
        return view('backend.posts.create', compact('attribute', 'languages', 'attributeSetId', 'postType', 'parent'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $destinationPath = 'uploads/';

        $images = $request->file('images');
        $imageData = [];
        if ($request->hasFile('images')) :
            foreach ($images as $file):
                $profileImage = rand(100000, 999999) . date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $profileImage);
                $imageData[] = [
                    'image' => $profileImage
                ];
            endforeach;
        endif;
        $thumbnail = $request->file('thumbnail');
        $thumbnailImage = rand(100000, 999999) . date('YmdHis') . "." . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($destinationPath, $thumbnailImage);

           $post = Post::create([
               'name' => $request->name,
               'parent_id' => $request->parent_id,
               'thumbnail' => $thumbnailImage,
               'images' => json_encode($imageData),
               'status' => $request->status
           ]);


           $attribute = Attribute::whereHas('attributeSets', function ($sql) use ($request) {
               $sql->where('attribute_set_id', $request->attribute_id);
           })->get();


           if ($request->language_id) {
               $data = [];
               foreach ($request->language_id as $key => $value) {
                   foreach ($attribute as $item) {
                       $code = $item->code;
                       $data[] = [
                           'post_id' => $post->id,
                           'attribute_id' => $item->id,
                           'language_id' => $request->language_id[$key],
                           'value' =>$request->get($item->code.$request->language_id[$key]),
                           'created_at' => DB::raw('CURRENT_TIMESTAMP'),
                           'updated_at' => DB::raw('CURRENT_TIMESTAMP')
                       ];
                   }
               }
               PostAttribute::insert($data);
           }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdatePostRequest $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}

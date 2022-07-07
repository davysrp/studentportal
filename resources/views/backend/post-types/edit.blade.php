@extends('layouts.adminapp')
                    @section('title','Post Types')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'post-types.update',
                            'model'=>$post_type,
                            'title'=>'Update Post Types',
                            'form_path'=>'backend.post-types.form'
                           ])
                    @endsection
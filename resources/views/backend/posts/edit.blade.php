@extends('layouts.adminapp')
@section('title','Update '.$postType->name)
@section('content')
    @include(
     'backend.libs.editForm',[
         'route'=>'posts.update',
         'model'=>$post,
         'title'=>'Update Posts',
         'form_path'=>'backend.posts.form'
        ])
@endsection

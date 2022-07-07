@extends('layouts.adminapp')
@section('title','Create '.$postType->name)
@section('content')
    @include(
     'backend.libs.createForm',[
         'route'=>'posts.store',
         'model'=>null,
         'title'=>'Create New',
         'form_path'=>'backend.posts.form'
        ])
@endsection

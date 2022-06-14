@extends('layouts.adminapp')
@section('title',"Rule")
@section('content')
   @include(
    'backend.libs.createForm',[
        'route'=>'permissions.store',
        'model'=>null,
        'title'=>"Create New",
        'form_path'=>"backend.permissions.form"
       ])

@endsection


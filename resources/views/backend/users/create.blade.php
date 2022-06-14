@extends('layouts.adminapp')
@section('title',"Admin")
@section('content')
   @include(
    'backend.libs.createForm',[
        'route'=>'admins.store',
        'model'=>null,
        'title'=>"Create New",
        'form_path'=>"backend.users.form"
       ])

@endsection


@extends('layouts.adminapp')
@section('title',"Admin")
@section('content')
    @include(
     'backend.libs.editForm',[
         'route'=>'admins.update',
         'model'=>$user,
         'title'=>"Update",
         'form_path'=>"backend.users.form"
        ])
@endsection


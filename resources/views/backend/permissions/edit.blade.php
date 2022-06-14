@extends('layouts.adminapp')
@section('title',"Admin")
@section('content')
    @include(
     'backend.libs.editForm',[
         'route'=>'permissions.update',
         'model'=>$permission,
         'title'=>"Update",
         'form_path'=>"backend.permissions.form"
        ])
@endsection


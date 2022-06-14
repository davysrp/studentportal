@extends('layouts.adminapp')
@section('title',"Admin")
@section('content')
    @include(
     'backend.libs.editForm',[
         'route'=>'rules.update',
         'model'=>$rule,
         'title'=>"Update",
         'form_path'=>"backend.rules.form"
        ])
@endsection


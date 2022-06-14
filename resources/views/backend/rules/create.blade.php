@extends('layouts.adminapp')
@section('title',"Rule")
@section('content')
   @include(
    'backend.libs.createForm',[
        'route'=>'rules.store',
        'model'=>null,
        'title'=>"Create New",
        'form_path'=>"backend.rules.form"
       ])

@endsection


@extends('layouts.adminapp')
@section('title','Labels')
@section('content')
    @include(
     'backend.libs.createForm',[
         'route'=>'labels.store',
         'model'=>null,
         'title'=>'Create New',
         'form_path'=>'backend.labels.form'
        ])
@endsection

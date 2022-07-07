@extends('layouts.adminapp')
@section('title','Labels')
@section('content')
    @include(
     'backend.libs.editForm',[
         'route'=>'labels.update',
         'model'=>$label,
         'title'=>'Update Labels',
         'form_path'=>'backend.labels.form'
        ])
@endsection

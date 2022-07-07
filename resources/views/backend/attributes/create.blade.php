@extends('layouts.adminapp')
                    @section('title','Attributes')
                    @section('content')
                       @include(
                        'backend.libs.createForm',[
                            'route'=>'attributes.store',
                            'model'=>null,
                            'title'=>'Create New',
                            'form_path'=>'backend.attributes.form'
                           ])
                    @endsection
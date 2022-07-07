@extends('layouts.adminapp')
                    @section('title','Post Types')
                    @section('content')
                       @include(
                        'backend.libs.createForm',[
                            'route'=>'post-types.store',
                            'model'=>null,
                            'title'=>'Create New',
                            'form_path'=>'backend.post-types.form'
                           ])
                    @endsection
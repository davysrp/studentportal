@extends('layouts.adminapp')
                    @section('title','Languages')
                    @section('content')
                       @include(
                        'backend.libs.createForm',[
                            'route'=>'languages.store',
                            'model'=>null,
                            'title'=>'Create New',
                            'form_path'=>'backend.languages.form'
                           ])
                    @endsection
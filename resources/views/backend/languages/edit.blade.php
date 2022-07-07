@extends('layouts.adminapp')
                    @section('title','Languages')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'languages.update',
                            'model'=>$language,
                            'title'=>'Update Languages',
                            'form_path'=>'backend.languages.form'
                           ])
                    @endsection
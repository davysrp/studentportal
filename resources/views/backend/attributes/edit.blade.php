@extends('layouts.adminapp')
                    @section('title','Attributes')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'attributes.update',
                            'model'=>$attribute,
                            'title'=>'Update attribute',
                            'form_path'=>'backend.attributes.form'
                           ])
                    @endsection
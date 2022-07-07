@extends('layouts.adminapp')
                    @section('title','Attribute Sets')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'attribute-sets.update',
                            'model'=>$attribute_set,
                            'title'=>'Update attribute_set',
                            'form_path'=>'backend.attribute-sets.form'
                           ])
                    @endsection

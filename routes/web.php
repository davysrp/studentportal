<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('admins', \App\Http\Controllers\UserContoller::class);
Route::resource('rules', \App\Http\Controllers\RuleContoller::class);
Route::resource('permissions', \App\Http\Controllers\PermissionContoller::class);


Route::group(['middleware' => 'role:developer'], function () {

    Route::get('/getadmin', function () {

        return 'Welcome Admin';

    });

});


Route::get('/table/{name}', function ($name) {
    $fields = \Illuminate\Support\Facades\Schema::getColumnListing($name);
//    Schema::getColumnType($table,$column),
    $textField = '';
    $form = '<div class="row">';
    $i = 1;
    $validateField = '';
    $validateMessage = '';
    foreach ($fields as $field) {
        if ($field != 'id' && $field != 'created_at' && $field != 'updated_at' && $field != 'deleted_at') {
            $textField .= '"' . $field . '"' . ',';
            $form .= ' <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label("' . $field . '") !!}
                            {!! Form::text("' . $field . '",null,["class"=>"form-control"]) !!}
                        </div>
                </div>';

            $validateField .= '' . $field . ': {
                        required: true,
                    },';
            $validateMessage = ''.$field.': {
                        required: "Please enter value in field  '.\Illuminate\Support\Str::headline($field).'",
                    },';


            if ($i % 2 == 0) {
                $form .= '</div><div class="row">';
            }
            $i++;
        }
    }
    $form .= '</div>';

    $result = substr($textField, 0, -1) . PHP_EOL;


    $createForm = "@extends('layouts.adminapp')
                    @section('title','".\Illuminate\Support\Str::headline($name)."')
                    @section('content')
                       @include(
                        'backend.libs.createForm',[
                            'route'=>'".$name.".store',
                            'model'=>null,
                            'title'=>'Create New',
                            'form_path'=>'backend.".$name.".form'
                           ])
                    @endsection";


    $editForm = "@extends('layouts.adminapp')
                    @section('title','".\Illuminate\Support\Str::headline($name)."')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'".$name.".update',
                            'model'=>$".  \Illuminate\Support\Str::singular($name).",
                            'title'=>'Update ".\Illuminate\Support\Str::singular($name)."',
                            'form_path'=>'backend.".$name.".form'
                           ])
                    @endsection";

    $jsValidate="@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    ".substr($validateField,0,-1)."

                },
                messages: {
                    ".substr($validateMessage,0,-1)."
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection";


    \Illuminate\Support\Facades\Storage::put($name . '/field.txt', $result, true);
    \Illuminate\Support\Facades\Storage::put($name . '/form.blade.php', $form.$jsValidate, true);
    \Illuminate\Support\Facades\Storage::put($name . '/create.blade.php', $createForm, true);
    \Illuminate\Support\Facades\Storage::put($name . '/edit.blade.php', $editForm, true);
//    return view('generrate',compact('fields'));
});


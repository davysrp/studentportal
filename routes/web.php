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
    $textField = '';
    $form = '<div class="row">';
    $i = 1;
    $validateField = '';
    $validateMessage = '';
    $thead = '';
    $td = '';

    foreach ($fields as $field) {
        if ($field != 'id' && $field != 'created_at' && $field != 'updated_at' && $field != 'deleted_at') {
            $textField .= '"' . $field . '"' . ',';
            $form .= ' <div class="col-md-6">
                        <div class="form-group {{ $errors->has("' . $field . '") ? "has-error" : "" }}">
                            {!! Form::label("' . $field . '") !!}
                            {!! Form::text("' . $field . '",null,["class"=>"form-control"]) !!}
                            {!! $errors->first("' . $field . '", \'<p class="help-block">:message</p>\') !!}
                        </div>
                </div>';

            $validateField .= '' . $field . ': {
                        required: true,
                    },';
            $validateMessage .= '' . $field . ': {
                        required: "Please enter value in field  ' . \Illuminate\Support\Str::headline($field) . '",
                    },' . PHP_EOL;

            $thead .= "<th>" . \Illuminate\Support\Str::headline($field) . "</th>" . PHP_EOL;
            $td .= "{data: '" . $field . "', name: '" . $field . "'}," . PHP_EOL;

            if ($i % 2 == 0) {
                $form .= '</div><div class="row">';
            }
            $i++;
        }
    }
    $form .= '</div>';

    $result = "protected $ fillable = [" . substr($textField, 0, -1) . " ];" . PHP_EOL;


    $createForm = "@extends('layouts.adminapp')
                    @section('title','" . \Illuminate\Support\Str::headline($name) . "')
                    @section('content')
                       @include(
                        'backend.libs.createForm',[
                            'route'=>'" . $name . ".store',
                            'model'=>null,
                            'title'=>'Create New',
                            'form_path'=>'backend." . $name . ".form'
                           ])
                    @endsection";


    $editForm = "@extends('layouts.adminapp')
                    @section('title','" . \Illuminate\Support\Str::headline($name) . "')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'" . $name . ".update',
                            'model'=>$" . \Illuminate\Support\Str::singular($name) . ",
                            'title'=>'Update " . \Illuminate\Support\Str::singular($name) . "',
                            'form_path'=>'backend." . $name . ".form'
                           ])
                    @endsection";

    $jsValidate = "@section('validation')
    <script>
        $(document).ready(function () {
            $('#_form').validate({
                rules: {
                    " . substr($validateField, 0, -1) . "

                },
                messages: {
                    " . substr($validateMessage, 0, -1) . "
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
@endsection" . PHP_EOL;


    $datatable = '@extends("layouts.adminapp")
@section("title","' . \Illuminate\Support\Str::headline($name) . '")
@section("card-title","' . \Illuminate\Support\Str::headline($name) . '")
@section("create-route",route("' . $name . '.create"))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            ' . $thead . '
        </tr>
        </thead>
    </table>
@endsection' . PHP_EOL;
    $datatable .= '@section("datatable")
    <script>
        $(document).ready(function () {
            $("table").dataTable({
                processing: true,
                serverSide: true,
                ajax: "{!! route("' . $name . '.index") !!}" ,
                columns: [
                    ' . $td . '
                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection';

    \Illuminate\Support\Facades\Storage::put($name . '/field.txt', $result, true);
    \Illuminate\Support\Facades\Storage::put($name . '/form.blade.php', $form . $jsValidate, true);
    \Illuminate\Support\Facades\Storage::put($name . '/create.blade.php', $createForm, true);
    \Illuminate\Support\Facades\Storage::put($name . '/edit.blade.php', $editForm, true);
    \Illuminate\Support\Facades\Storage::put($name . '/index.blade.php', $datatable, true);
});


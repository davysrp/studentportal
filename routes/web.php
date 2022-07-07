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
Route::resource('attributes', \App\Http\Controllers\AttributeController::class);
Route::resource('attribute-sets', \App\Http\Controllers\AttributeSetController::class);

Route::resource('permissions', \App\Http\Controllers\PermissionContoller::class);
Route::resource('students', \App\Http\Controllers\StudentController::class);
Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
Route::resource('setting', \App\Http\Controllers\SettingController::class);
Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('posts', \App\Http\Controllers\PostController::class);
Route::resource('post-types', \App\Http\Controllers\PostTypeController::class);
Route::resource('language', \App\Http\Controllers\LanguageController::class);
Route::resource('labels', \App\Http\Controllers\LabelController::class);
Route::resource('languages', \App\Http\Controllers\LanguageController::class);
Route::resource('category', \App\Http\Controllers\LanguageController::class);
Route::resource('post', \App\Http\Controllers\PostController::class);
Route::get('localization/{locale}',[\App\Http\Controllers\LocalizationController::class,'index']);
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
    $ruleField = '';
    foreach ($fields as $field) {
        if ($field != 'id' && $field != 'created_at' && $field != 'updated_at' && $field != 'deleted_at') {
            $textField .= '"' . $field . '"' . ',' . PHP_EOL;
            $ruleField .= ' "' . $field . '" => "required",' . PHP_EOL;
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

    $result = "protected $ fillable = [" . substr($textField, 0, -3) . " ];" . PHP_EOL . substr($ruleField, 0, -3) . PHP_EOL;

    $createForm = "@extends('layouts.adminapp')
                    @section('title','" . \Illuminate\Support\Str::headline($name) . "')
                    @section('content')
                       @include(
                        'backend.libs.createForm',[
                            'route'=>'" . \Illuminate\Support\Str::slug($name) . ".store',
                            'model'=>null,
                            'title'=>'Create New',
                            'form_path'=>'backend." . \Illuminate\Support\Str::slug($name) . ".form'
                           ])
                    @endsection";


    $editForm = "@extends('layouts.adminapp')
                    @section('title','" . \Illuminate\Support\Str::headline($name) . "')
                    @section('content')
                       @include(
                        'backend.libs.editForm',[
                            'route'=>'" . \Illuminate\Support\Str::slug($name) . ".update',
                            'model'=>$" . \Illuminate\Support\Str::singular($name) . ",
                            'title'=>'Update "  . \Illuminate\Support\Str::headline($name)  . "',
                            'form_path'=>'backend." . \Illuminate\Support\Str::slug($name) . ".form'
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
@section("create-route",route("' . \Illuminate\Support\Str::slug($name) . '.create"))
@section("table")
    <table class="table table-hover">
        <thead>
        <tr>
            ' . $thead . '
            <th>Action</th>
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
                ajax: "{!! route("' . \Illuminate\Support\Str::slug($name) . '.index") !!}" ,
                columns: [
                    ' . $td . '
                    {data: "action", name: "action", orderable: false, searchable: false}
                ]
            })
        })
    </script>
@endsection';

    \Illuminate\Support\Facades\Storage::put(\Illuminate\Support\Str::slug($name) . '/field.txt', $result, true);
    \Illuminate\Support\Facades\Storage::put(\Illuminate\Support\Str::slug($name) . '/form.blade.php', $form . $jsValidate, true);
    \Illuminate\Support\Facades\Storage::put(\Illuminate\Support\Str::slug($name) . '/create.blade.php', $createForm, true);
    \Illuminate\Support\Facades\Storage::put(\Illuminate\Support\Str::slug($name) . '/edit.blade.php', $editForm, true);
    \Illuminate\Support\Facades\Storage::put(\Illuminate\Support\Str::slug($name) . '/index.blade.php', $datatable, true);
});


Route::get('/getcat', function () {
    $path_en = storage_path() . "/cat_en.json";
    $path_kh = storage_path() . "/cat_kh.json";
    $jsonEn = json_decode(file_get_contents($path_en), true);
    $jsonKh = json_decode(file_get_contents($path_kh), true,);

    $cateEnData = [];
    $cateKhData = [];

    return view('cat', compact('jsonKh'));
/*    foreach ($jsonEn as $item) {
        foreach ($item['children'] as $child) {

            $cateEnData[] = $child['category_name'];
        }
    }
    $i = 0;
    foreach ($jsonKh as $itemKh) {
        foreach ($itemKh['children'] as $childKh) {

            $cateKhData[] = $childKh['category_name'].','.$cateEnData[$i++];
        }
    }*/

//    \Illuminate\Support\Facades\Storage::put( '/child.txt', json_encode($cateKhData), true);

    /*    $names = \Illuminate\Support\Facades\DB::table('names')->get();
        $name__ ='';
        $i = 1;
        foreach ($names as $item) {
            $name__ .= '{'.PHP_EOL;
            $name__ .= '"category_attribute_set_id": 43,'.PHP_EOL;
            $name__ .= '"position": '.$i++.','.PHP_EOL;
            $name__ .= ' "url": "beauty",'.PHP_EOL;
            $name__ .= '"level": 2,'.PHP_EOL;
            $name__ .= ' "parent_id": 32,'.PHP_EOL;
            $name__ .= '"attribute_id":[29,29],'.PHP_EOL;
            $name__ .= '"banner":"'.$item->name_kh . '",'.PHP_EOL;
            $name__ .= '"category_code":"'.$item->name_kh . '",'.PHP_EOL;
            $name__ .= '"language":["en","kh"],'.PHP_EOL;
            $name__ .= '"value":["'.$item->name_kh . '","' . $item->name.'"]'.PHP_EOL;
            $name__ .= '}'.PHP_EOL;
        }
        \Illuminate\Support\Facades\Storage::put( '/names.txt', $name__, true);*/






});

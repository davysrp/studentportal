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


Route::group(['middleware' => 'role:developer'], function() {

    Route::get('/getadmin', function() {

        return 'Welcome Admin';

    });

});


Route::get('/roles', [\App\Http\Controllers\PermissionContoller::class,'Permission']);


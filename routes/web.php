<?php

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
Route::get('reg','Admin\UserController@reg');
Route::any('regDo','Admin\UserController@regDo');
Route::get('/','Admin\UserController@login');
Route::any('loginDo','Admin\UserController@loginDo');

Route::prefix('admin')->middleware('islogin')->group(function(){
    Route::any('/index','Admin\AdminController@index');
});

Route::get('test','Admin\UserController@test');

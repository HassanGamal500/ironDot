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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/user', 'HomeController@user')->name('user')->middleware('user');
Route::get('/admin', 'HomeController@admin')->name('admin')->middleware('admin');
Route::get('/edit/{id}', 'UserController@edit')->name('edit');
Route::put('/update/{id}', 'UserController@update')->name('update');


Route::get('/message', function (){
    return 'You cannot access this page';
});
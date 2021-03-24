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
    return 'Home';
});

Route::group(['namespace'=>'Admin'], function (){
    Route::get('second', 'SecondController@showString');
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/landing', function () {
    return view('landing');
});

Auth::routes(['verify'=>true]);




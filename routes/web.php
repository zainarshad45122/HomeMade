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

Route::get('/admin', 'adminController@index');
Route::get('/chef/reports','adminController@chefreports');
Route::get('/sales','adminController@getsales');
Route::post('/chef/report','adminController@chefreport');
Route::get('/allchefs','adminController@getchefs');
Route::post('/allchef','adminController@getchef');

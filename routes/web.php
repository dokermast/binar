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

Route::get('/', 'MainController@main')->name('main');
Route::get('/list', 'MainController@list')->name('list');
Route::get('/add', 'MainController@add')->name('add');
Route::post('/save', 'MainController@save')->name('save');
Route::get('/relatives/{id}', 'MainController@getRelatives')->name('relatives');
Route::get('/positions/{id}', 'MainController@getAvailablePosition');



//Route::get('/', function () {
//    return view('welcome');
//});

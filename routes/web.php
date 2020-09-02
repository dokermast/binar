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

Route::get('/', 'BinarController@main')->name('main');
Route::get('/list', 'BinarController@list')->name('list');
Route::get('/add', 'BinarController@add')->name('add');
Route::post('/save', 'BinarController@save')->name('save');
Route::get('/relatives/{id}', 'BinarController@getRelatives')->name('relatives');
Route::get('/positions/{id}', 'BinarController@getAvailablePosition')->name('positions');



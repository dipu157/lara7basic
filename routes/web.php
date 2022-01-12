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

Route::get('/', function () { return view('Home'); });
Route::get('/dashboard', function () { return view('Home'); });

Route::get('/basiccrud','CrudController@basicCrudIndex');
Route::get('/basicCrudData','CrudController@AllBasicCrudData');
Route::post('/basiccrudAdd','CrudController@BasicCrudAdd');
Route::post('/basiccruddelete','CrudController@BasicCrudDelete');
Route::post('/basicCrudDetails','CrudController@BasicCrudDetails');
Route::post('/basicCrudUpdateClick','CrudController@BasicCrudUpdate');

Route::get('/othercrud','CrudController@otherCrudIndex');
Route::get('/otherCrudData','CrudController@AllOtherCrudData');
Route::post('/othercruddelete','CrudController@OtherCrudDelete');

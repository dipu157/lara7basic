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

Route::get('/', 'HomeController@loginIndex');
Route::post('/login', 'LoginController@onLogin');
Route::get('/logout', 'LoginController@onLogOut');

Route::get('/register', 'LoginController@register');
Route::post('/userRegister', 'LoginController@userRegister');

Route::get('/dashboard', 'HomeController@HomeIndex')->middleware('loginCheck');

Route::get('/basiccrud','CrudController@basicCrudIndex');
Route::get('/basicCrudData','CrudController@AllBasicCrudData');
Route::post('/basiccrudAdd','CrudController@BasicCrudAdd');
Route::post('/basiccruddelete','CrudController@BasicCrudDelete');
Route::post('/basicCrudDetails','CrudController@BasicCrudDetails');
Route::post('/basicCrudUpdateClick','CrudController@BasicCrudUpdate');

Route::get('/othercrud','CrudController@otherCrudIndex');
Route::get('/otherCrudData','CrudController@AllOtherCrudData');
Route::post('/othercruddelete','CrudController@OtherCrudDelete');
Route::post('/photoUp/{id}','CrudController@photoUpload');
Route::post('/othercrudAdd','CrudController@OtherCrudAdd');
Route::post('/otherCrudUpdateBtnClick','CrudController@OtherCrudUpdate');
Route::post('/otherCrudDetails','CrudController@otherCrudDetails');

//HRM RELATED ROUTE

Route::group(['prefix' => 'hrm'], function () {

    //HRM Route

    Route::get('hrmcrud',['as'=>'hrm/hrmcrud','uses' => 'HrmCrudController@hrmCrudIndex']);
    Route::get('hrmCrudDataTable','HrmCrudController@hrmCrudData'); // Data Table Roure
    Route::post('newhrmCrudSave',['as'=>'hrm/newhrmCrudSave','uses' => 'HrmCrudController@create']);
    Route::post('image/save',['as'=>'hrm/image/save','uses' => 'HrmCrudController@updateImage']);
    Route::post('hrmCrudUpdate',['as'=>'hrm/hrmCrudUpdate','uses' => 'HrmCrudController@update']);
    Route::post('hrmCrudDelete',['as'=>'hrm/hrmCrudDelete','uses' => 'HrmCrudController@Delete']);
   // Route::post('hrm/hrmCrudUpdate', 'HrmCrudController@update');

});


// Multiple Data to Multiple Table

Route::get('/multiTable','MultiTableController@index');

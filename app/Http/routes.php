<?php

/*	
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::any('v1/api/device/1',function (\Illuminate\Http\Request $request){
    return "success".$request;
});

Route::any('v1/api/device/{did}','Api\Device@saveData');



Route::get('/admin', 'Admin\Page@index');
Route::get('/admin/map', 'Admin\Page@map');
Route::resource('/admin/user','Admin\User');
Route::resource('/admin/waterarea','Admin\WaterArea');
Route::resource('/admin/monitorpoint','Admin\MonitorPoint');
//Route::get('/admin/waterarea','Admin\Page@waterarea');
//Route::get('/admin/monitorpoint','Admin\Page@monitorpoint');
Route::get('/admin/data/jsonapi','Admin\Data@jsonapi');

Route::get('/admin/data/analysis','Admin\MonitorPoint@index');
Route::get('/admin/data/analysis/{pid}','Admin\Data@analysis');
//Route::get('/admin/data/analysis/000000','Admin\Data@analysis');

Route::get('/admin/data','Admin\MonitorPoint@index');
Route::get('/admin/syslog','Admin\Page@syslog');
Route::get('/admin/syssetting','Admin\Page@syssetting');

Route::get('/admin/data/ajaxdata/{pid}','Admin\Data@ajaxdata');

Route::get('/admin/data/ajaxanalysis/{pid}','Admin\Data@ajaxanalysis');
// Route::get('/admin/data/ajaxanalysis/000000','Admin\Data@ajaxanalysis');


Route::get('/admin/data/{pid}','Admin\Data@index');


//Route::get('admin/login','Auth\AuthController@showLoginForm');
Route::get('admin/login','Auth\LoginController@showLoginForm');
//Route::get('admin/logout','Auth\AuthController@logout');
Route::get('admin/logout','Auth\LoginController@logout')->name('logout');

//Route::post('admin/login', 'Auth\AuthController@login');
Route::post('admin/login', 'Auth\LoginController@login');



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
/*
Route::group(['middleware' => 'web'], function () {

    //Route::auth();
    Route::get('login', 'Auth\AuthController@showLoginForm');
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');

// Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

// Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    Route::get('/home', 'HomeController@index');
});
*/
Route::get('/{name}', function ($name) {
    return view($name);
});
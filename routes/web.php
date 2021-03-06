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

Route::get('/', 'Auth\LoginController@index' );

Route::get('/login', 'Auth\LoginController@showLoginForm()' );

Route::get('/register', function(){
    return view('adminlte::auth.register');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

Route::resource('user', 'UserController', ['only' => [
    'update'
]]);

Route::resource('database/upsheet', 'UpsheetController');

Route::resource('database/meo_client', 'MeoClientController');

Route::resource('job', 'JobController', ['only' => [
    'create', 'store'
]]);

Route::resource('administration/agency', 'AgencyController', ['only' => [
    'create', 'store'/*, 'update'*/, 'destroy'
]]);

Route::resource('administration/role', 'RoleController', ['only' => [
    'create', 'edit','store', 'update', 'destroy'
]]);

Route::resource('administration/permission', 'PermissionController', ['only' => [
    'create', 'edit','store', 'update', 'destroy'
]]);



Route::resource('supervisor', 'SupervisorController', ['only' => [
    'create', 'store'
]]);

Route::resource('operator', 'OperatorController', ['only' => [
    'create', 'store'
]]);

Route::resource('manager', 'ManagerController', ['only' => [
    'create', 'store'
]]);

Route::resource('seller', 'SellerController', ['only' => [
    'create', 'store'
]]);

Route::resource('rh/collaborator', 'CollaboratorController');


Route::get('/online_users', function(){
    return view('admin.homepages.online_users');
});

Route::get('/rh', function(){
    return view('admin.homepages.rh');
});

Route::get('/database', function(){
    return view('admin.homepages.database');
});

Route::get('/accounting', function(){
    return view('admin.homepages.accounting');
});

Route::get('/administration', function(){
    return view('admin.homepages.administration');
});
Route::get('/users/{id}/settings', 'UserController@show');

Route::get('/age', 'ScriptController@age_calculator');
Route::get('/get_supervisor', 'ScriptController@get_supervisor');
Route::get('/tour_calculate', 'ScriptController@tour_calculate');


Route::get('administration/agencies', 'AgencyController@index');

Route::get('administration/agency/{id}', 'AgencyController@update_agency');

Route::get('administration/agency/{id}', 'AgencyController@act_deact_agency');

Route::get('administration/jobs', 'JobController@index');

Route::get('administration/job/{id}', 'JobController@update_job');

Route::get('administration/permission_area', 'PermissionController@index');

Route::get('administration/roles', 'RoleController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

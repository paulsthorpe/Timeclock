<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});





Route::get('/admin', 'EmployeesController@index');

Route::get('/admin/employee/add', 'EmployeesController@add');

Route::post('/admin/employee/create', 'EmployeesController@create');

Route::get('/admin/employee/edit/{employee}', 'EmployeesController@edit');

Route::patch('/admin/employee/{employee}', 'EmployeesController@update');

Route::get('/admin/employee/delete/{employee}', 'EmployeesController@check_delete');

Route::delete('/admin/employee/{employee}', 'EmployeesController@delete');





Route::post('/log_time', 'TimeController@log_time');

Route::get('/admin/period_hours', 'TimeController@period_hours');

Route::post('/admin/period_hours/add', 'TimeController@add_hours');

Route::get('/admin/period_hours/{employee}', 'TimeController@employee_time');

Route::get('/admin/period_hours/{employee}/edit', 'TimeController@edit_hours');

Route::get('/admin/period_hours/{employee}/add', 'TimeController@add_hours');

Route::delete('/admin/period_hours/delete/{id}', 'TimeController@delete_hours');

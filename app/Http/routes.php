<?php


Route::get('/', function () {
    return view('welcome');
});

Route::post('/log_time', 'TimeController@clockIn');

Route::get('/home', 'HomeController@index');



Route::auth();

Route::group(['middleware' => 'auth'], function(){

  /*
  |--------------------------------------------------------------------------
  | Admin Employee Routes
  |--------------------------------------------------------------------------
  */



  Route::get('/admin/employee/add', 'EmployeesController@add');

  Route::get('/admin/employee/edit/{employee}', 'EmployeesController@edit');




  Route::get('/admin', 'EmployeesController@index');

  Route::post('/admin/employee/create', 'EmployeesController@create');

  Route::patch('/admin/employee/{employee}', 'EmployeesController@update');

  Route::delete('/admin/employee/{employee}', 'EmployeesController@delete');

  /*
  |--------------------------------------------------------------------------
  | Admin Timeclock Routes
  |--------------------------------------------------------------------------
  */



  Route::post('/admin/period_hours/add', 'TimeController@add');

  Route::get('/admin/period_hours/{employee}', 'TimeController@employee_time');




  Route::get('/admin/period_hours', 'TimeController@index');

  Route::post('/admin/period_hours/add/{employee}', 'TimeController@create');

  Route::delete('/admin/period_hours/delete/{id}', 'TimeController@delete');

});

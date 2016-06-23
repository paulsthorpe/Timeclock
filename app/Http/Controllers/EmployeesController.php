<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee;
use App\TimeRecord;

class EmployeesController extends Controller
{


  /**
   *  query all employees and pass to view,
   *  this view shows all employees
   *
   */


    public function index(){

      $employees = Employee::all();

      return view('employee.view_employees', compact('employees'));

    }



    /**
     * Timeclock Routes
     *
     *
     */


    public function add(){

      return view('employee.add_employee');
    }



    /**
     *
     *  get post request containing employee info,
     *  create new employee model and assign request info,
     *  persist new employee to the database
     *
     */


    public function create(Request $request){
      //make new employee model
      $employee = new Employee;
      //assign data
      $employee->id = $request->employee_id;

      $employee->first_name = $request->first_name;

      $employee->last_name = $request->last_name;

      $employee->phone_no = $request->phone_no;

      $employee->clocked_in = 0;
      //persist model to database
      $employee->save();

      return redirect('/admin');
    }



    /**
     *  get employee model via get request and then pass to view,
     *  this view populates a form with current info for editing
     *
     */


    public function edit(Employee $employee){

      return view('employee.edit_employee', compact('employee'));

    }



    /**
     *  get employee model and post data and update employee model
     *  with request data. redirect back to employee index view
     *
     */


    public function update(Request $request, Employee $employee){

      $employee->update($request->all());

      return redirect('/admin');
    }



    /**
     * Timeclock Routes
     *
     *
     */


    public function check_delete(Employee $employee){
      return $employee;
      // return view('admin.employee.check_delete', compact('employee'));
    }



    /**
     * Timeclock Routes
     *
     *
     */


    public function delete(Employee $employee){
      $employee->delete();

      return redirect('/admin');
    }



    /**
     * Timeclock Routes
     *
     *
     */


    public function time_index(){

      return view('employee.hours_overview');
      //view not made yet
    }



    /**
     * Timeclock Routes
     *
     *
     */


    public function time_by_index(){

      return view('employee.employee_hours');
      //view not made yet
    }



    /**
     * Timeclock Routes
     *
     *
     */


    public function edit_hours(){

      return view('employee.edit_hours');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee;
use App\TimeRecord;

class EmployeesController extends Controller
{


    /**
     * query all employees and pass to view,
     * @return mixed
     */
    public function index()
    {

        $employees = Employee::all();

        return view('employee.view_employees', compact('employees'));

    }


    public function add()
    {
        return view('employee.add_employee');
    }


    /**
     * create new employee, persist to db
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
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
     * populate form to edit employee info
     * @param Employee $employee
     * @return mixed
     */
    public function edit(Employee $employee)
    {

        return view('employee.edit_employee', compact('employee'));

    }


    /**
     * update employee model
     * @param Request $request
     * @param Employee $employee
     * @return mixed
     */
    public function update(Request $request, Employee $employee)
    {

        $employee->update($request->all());

        return redirect('/admin');
    }

    /**
     * delete employee model
     * @param Employee $employee
     * @return mixed
     */
    public function delete(Employee $employee)
    {
        $employee->delete();

        return redirect('/admin');
    }

}

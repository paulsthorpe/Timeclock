<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
//Models
use App\Employee;
use App\TimeRecord;
//Sevices
use App\Services\Timeclock;


class TimeController extends Controller
{


    /**
     * Inject TimeclockService
     * @param TimeclockService $timeclock
     */
    public function __construct(TimeclockService $timeclock)
    {
        $this->timeService = $timeclock;
    }


    /**
     * Clock employee in/out and flash success/fail message
     * @param Request $request
     * @return mixed
     */
    public function clockIn(Request $request)
    {

        $employee = Employee::find($request->employee_id);
        $return = $this->timeService->clockIn($employee);

        if ($return === 0) {
            Session::flash('failed', 'Clock in/out was unsuccessful, please try again');
        } elseif ($return === 1) {
            Session::flash('success', $employee->first_name . ', your clock in was successful');
        } else {
            Session::flash('success', $employee->first_name . ', your clock out was successful');
        }

        return redirect('/home');
    }


    /**
     *  Send all Employees to period_hours view
     *  This view displays all empoyees and their hours for current period
     * @return mixed
     */
    public function index()
    {

        $employees = Employee::all();

        return view('employee.period_hours', compact('employees'));

    }


    /**
     * Create time record from form, not the clockin page
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {

        $this->timeService->addRecord($request);

        return back();

    }


    /**
     * delete time record
     * @param TimeRecord $id
     * @return mixed
     */
    public function delete(TimeRecord $id)
    {

        $id->delete();

        return back();

    }


    /**
     *  Send employee, an their time records to the view
     *  This view shows detailed time records for the selected employee
     * @param Employee $employee
     * @return mixed
     */
    public function employee_time(Employee $employee)
    {

        $time_records = $employee->time;

        return view('employee.time_by_employee', compact('employee', 'time_records'));

    }


}

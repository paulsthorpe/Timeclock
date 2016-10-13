<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Employee;
use App\TimeRecord;
use App\Services\Timeclock;
use Carbon\Carbon;
use Session;


class TimeController extends Controller
{

  public function __construct(TimeclockService $timeclock)
  {
      $this->timeService = $timeclock;
  }



  /**
   *
   *  Send all Employees to period_hours view
   *  This view displays all empoyees and their hours for current period
   *
   */


  public function period_hours(){

    $employees = Employee::all();

    return view('employee.period_hours', compact('employees'));

  }




  /**
   *
   *  Send employee, an thier time records to the view
   *  This view shows detailed time records for the selected employee
   *
   */


  public function employee_time(Employee $employee){

    $time_records = $employee->time;

    return view('employee.time_by_employee', compact('employee', 'time_records'));

  }



  /**
   * Timeclock Routes
   *
   *
   */


  public function add_hours(Request $request){

    $this->timeService->addRecord($request);

    return back();

  }




  /**
   * Timeclock Routes
   *
   *
   */


  public function delete_hours(TimeRecord $id){

    $id->delete();

    return back();

  }




  /**
   *  Get employee_id by post, query that employee
   *  and then call the clockIn method from TimeClock class to handle
   *  clocking in/out process, then redirect back to user_path view
   *
   */


  public function log_time(Request $request){

    $employee = Employee::find($request->employee_id);

    $return = $this->timeService->clockIn($employee);

    if($return === 0){
      Session::flash('failed', 'Clock in/out was unsuccessful, please try again');
    } elseif($return === 1){
      Session::flash('success', $employee->first_name.', your clock in was successful');
    } else {
      Session::flash('success', $employee->first_name.', your clock out was successful');
    }


    return redirect('/home');

    //flash employee success/fail

  }



  /**
   * Timeclock Routes
   *
   *
   */


  public function editTime() {

  }

}

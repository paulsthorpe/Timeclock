<?php

namespace App\Services;

use Carbon\Carbon;
use App\Employee;
use App\TimeRecord;


/*
|--------------------------------------------------------------------------
| Timeclock Class
|--------------------------------------------------------------------------
|
| Provides useful static functions to use throught the appliction to assist in
| handling data related to employee time tracking and reporting
|
|
*/

class TimeclockService
{


    /**
     * clock employee in and out and return numeric value to determine flash message in controller
     * @param $employee
     * @return int
     */
    public static function clockIn($employee)
    {
        if (!$employee) {
            return 0;
        }
        //check employee clock in status
        if ($employee->clocked_in == 0) {

            //if not clocked in instantiate a new timerecord, set clock in time and save
            $punch = new TimeRecord;
            $punch->clock_in = Carbon::now();

            $employee->time()->save($punch);

            //update employee clocked_in flag
            $employee->clocked_in = 1;
            $employee->update();

            return 1;

        } else if ($employee->clocked_in == 1) {

            //if employee is clocked in, pull most recent timerecord and assign a clock out value, then update
            $punch = $employee->time->last();
            $punch->clock_out = Carbon::now();

            $punch->secs = Self::calcSecs($punch->clock_out, $punch->clock_in);

            $punch->update();
            //update employee clocked_in flag
            $employee->clocked_in = 0;
            $employee->update();
            return 2;
        }
    }


    /**
     * @param $out
     * @param $in
     * @return string
     */
    public static function calcSecs($out, $in)
    {

        $secs = Self::cbnToUnix($out) - Self::cbnToUnix($in);

        return $secs;

    }

    public static function cbnToUnix($carbon)
    {
        $date = Carbon::parse($carbon)->format('U');
        return $date;
    }

    /**
     * return string for table row that display employee period hrs
     * @param $employees
     */
    public static function displayPeriodHours($employees)
    {


        foreach ($employees as $employee) {

            $totalTime = 0;

            foreach ($employee->time as $time) {

                $totalTime += $time->secs;

            }

            $hours = Self::secsToHrs($totalTime);

            $html_out = "<tr><td>{$employee->id}</td><td>{$employee->first_name}&nbsp{$employee->last_name}</td>";
            $html_out .= "<td>{$hours}</td><td class='text-center'><a class='btn btn-primary btn-xs' ";
            $html_out .= "href='/admin/period_hours/{$employee->id}' style='width: 150px;'>View/Edit for {$employee->first_name}";
            $html_out .= "</a></td></tr>";

            echo $html_out;
        }

    }

    /**
     * converts second to h:m:s string
     * @param $time
     * @return string
     */
    public static function secsToHrs($time)
    {

        $secs = $time % 60;

        $mins = ($time - $secs) / 60;

        $hrs = $mins / 60;

        $hrs = floor($hrs);

        if ($hrs >= 1) {

            $mins = $mins % 60;
            return $hrs . ":" . $mins . ":" . $secs;

        } elseif ($hrs <= 1) {

            return $mins . ":" . $secs;

        }

    }

    /**
     * add time record from form
     * @param $request
     */
    public static function addRecord($request)
    {
        $employee = Employee::find($request->employee);
        $record = new TimeRecord();
        $in = $request->date;
        $in .= "/" . $request->hour_in . "/" . $request->min_in . "/" . $request->am_pm_in;

        $record->clock_in = Carbon::createFromFormat('m/d/Y/h/i/A', $in);

        $out = $request->date;
        $out .= "/" . $request->hour_out . "/" . $request->min_out . "/" . $request->am_pm_out;

        $record->clock_out = Carbon::createFromFormat('m/d/Y/h/i/A', $out);

        $record->secs = self::cbnToUnix($record->clock_out) - self::cbnToUnix($record->clock_in);

        $employee->time()->save($record);
    }

    //carbon instance to unix timestamp

    /**
     * employees total time
     * @param $id
     * @return string
     */
    public static function totalTime($id)
    {
        $employee = Employee::find($id);

        $totalTime = 0;

        foreach ($employee->time as $time) {

            $totalTime += $time->secs;

        }
        return self::secsToHrs($totalTime);
    }

    //carbon instance ro mdy format string

    public static function cbnToMDY($carbon)
    {
        $date = Carbon::parse($carbon)->format('m-d-Y');
        return $date;
    }

    //carbon instance from month,date format. assumes current year

    public static function cbnfrmMD($m, $d)
    {
        $date = Carbon::createFromDate(null, $m, $d);
        return $date;
    }

    //carbon instance from unix format
    public static function cbdfrmUnix($unix)
    {
        $date = Carbon::createFromTimestamp($unix)->toDateTimeString();
        return $date;
    }

    public static function cbnfromHMS($h, $m, $s)
    {
        $date = Carbon::createFromTime($h, $m, $d);
        return $date;
    }

    public static function cbnToHMS($carbon)
    {
        $date = Carbon::parse($carbon)->format('h:i:s A');
        return $date;
    }

    public static function cbnfrmMDHMS($m, $d, $h, $min, $s)
    {
        $date = Carbon::create(null, $m, $d, $h, $min, $s);
        return $date;
    }


} //end TimeClock class

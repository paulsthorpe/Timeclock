<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use App\Employee;
use Excel;
use App\Services\Timeclock;


class Payroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timeclock:payroll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Excel $excel,Timeclock $timeclock)
    {
        parent::__construct();
        $this->excel = $excel;
        $this->timeclock = $timeclock;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){

        $employees = Employee::with(['time' => function($query){

          $query->select('employee_id','clock_in','clock_out','secs');

        }])->select('id', 'first_name', 'last_name', 'phone_no')->get();



        $this->excel::create('Payroll '.date('m-d-Y').'', function($excel) use($employees){

          foreach($employees as $employee){

              $excel->sheet($employee->first_name.' '.$employee->last_name, function($sheet) use($employee){

                $totalTime = 0;

                foreach($employee->time as $time){

                  $totalTime += $time->secs;

                  $time->hours = $this->timeclock::secsToHrs($time->secs);

                  unset($time->secs);

                }

                $sheet->fromArray($employee->time);

                $sheet->setFontSize(16);
                $sheet->setAutoSize(true);

                $sheet->appendRow(array(
                  '', ''
                ));

                $sheet->appendRow(array(
                  '', '', 'Total:', $this->timeclock::secsToHrs($totalTime)
                ));


              });

          }

        })->store('xls');

    }
}

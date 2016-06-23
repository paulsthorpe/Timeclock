@extends('admin_panel.admin_template')

@section('title')
Hours for {{$employee->first_name}}&nbsp{{$employee->last_name}}
@endsection

@section('admin_content')
<section class="content-header">
    <h1>
    Hours This Period For {{$employee->first_name}}&nbsp{{$employee->last_name}}
  </h1>
</section>
<br>
<br>
<div class="container">
    <div class="row col-md-10 col-md-offset-1 custyle">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Total Time</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            @foreach($time_records as $time)
            <tr>
                <td>{{App\Services\Timeclock::cbnToMDY($time->clock_in)}}</td>
                <td>{{App\Services\Timeclock::cbnToHMS($time->clock_in)}}</td>
                <td>{{App\Services\Timeclock::cbnToHMS($time->clock_out)}}</td>
                <td>{{App\Services\Timeclock::secsToHrs($time->secs)}}</td>
                <td class="text-center">
                    <form action="/admin/period_hours/delete/{{$time->id}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class='btn btn-danger btn-xs' type="submit" name="submit" style="width: 150px;">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
              <td></td>
              <td></td>
              <td>Total This Period:</td>
              <td>{{App\Services\Timeclock::totalTime($employee->id)}}</td>
              <td></td>
            </tr>

        </table>
    </div>
</div>
<section class="content-header">
    <h1>
    Add Time Record For {{$employee->first_name}}&nbsp{{$employee->last_name}}
  </h1>
</section>
<br>
</br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">

            <form method="POST" action="/admin/period_hours/add">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="employee" value="{{$employee->id}}">
                <!-- ADD RECORD -->

                    <div class="form-group col-sm-12">
                        <div class="form-group col-sm-6">
                            <label class="control-label " for="date">
                                Select Date
                            </label>
                            <input type="text" class="form-control col-sm-6" id="startDate" name="date">
                        </div>
                    </div>
                    <br>
                    <br>


                    <!-- SELECT ADD DATE OPTION -->


                        <div class="form-group col-sm-4">
                            <label class="control-label requiredField" for="in">
                                Time In
                            </label>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label requiredField" for="total">
                                        Hour
                                    </label>
                                    <input class="form-control" name="hour_in" placeholder="00" type="text" />
                                    <br>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label requiredField" for="total">
                                        Minute
                                    </label>
                                    <input class="form-control" name="min_in" placeholder="00" type="text" />
                                    <br>
                                </div>
                            </div>
                            <label class="control-label requiredField" for="in">
                                AM/PM
                            </label>
                            <select class="select form-control" name="am_pm_in">
                                <option value="AM">
                                    AM
                                </option>
                                <option value="PM">
                                    PM
                                </option>
                            </select>
                        </div>
                        <!-- Add IN SECTION -->
                        <div class="form-group col-sm-4">
                            <label class="control-label requiredField" for="out">
                                Time Out
                            </label>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label requiredField" for="hr">
                                        Hour
                                    </label>
                                    <input class="form-control" name="hour_out" placeholder="00" type="text" />
                                    <br>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label requiredField" for="min">
                                        Minute
                                    </label>
                                    <input class="form-control" name="min_out" placeholder="00" type="text" />
                                    <br>
                                </div>
                            </div>
                            <label class="control-label requiredField" for="out">
                                AM/PM
                            </label>
                            <select class="select form-control" name="am_pm_out">
                                <option value="AM">
                                    AM
                                </option>
                                <option value="PM">
                                    PM
                                </option>
                            </select>
                        </div>
                        <!-- Add OUT SECTION -->

                    <!-- Row for add options -->
                    <div class="form-group col-sm-12">
                        <div>
                            <button class="btn btn-primary " name="submit" type="submit">
                                Add Value
                            </button>
                        </div>
                    </div>
            </form>
            <!-- ADD FORM -->



        </div>
    </div>


</div>


@endsection

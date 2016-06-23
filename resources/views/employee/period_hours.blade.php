@extends('admin_panel.admin_template')

@section('title')
Hours for employee
@endsection

@section('admin_content')
<section class="content-header">
  <h1>
    Employee Hours For Period
  </h1>
</section>
<div class="container">
    <div class="row col-md-6 col-md-offset-2 custyle">
    <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Hours</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
      {{App\Services\Timeclock::displayPeriodHours($employees)}}
    </table>
    </div>
</div>

@endsection


<!--
.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }


 -->

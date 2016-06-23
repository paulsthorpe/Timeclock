@extends('admin_panel.admin_template')

@section('title')
Add Employee
@endsection

@section('admin_content')
<section class="content-header">
  <h1>
    Edit Employee
  </h1>
</section>
<br>
</br>
<div class="container-fluid">
 <div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
   <form method="POST" action="/admin/employee/{{$employee->id}}">
     {{method_field('PATCH')}}
     <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group ">
     <label class="control-label requiredField" for="name">
      First Name
      <span class="asteriskField">
       *
      </span>
     </label>
     <input class="form-control" id="name" name="first_name" type="text" value="{{$employee->first_name}}"/>
    </div>
    <div class="form-group ">
     <label class="control-label requiredField" for="last_name">
      Last Name
      <span class="asteriskField">
       *
      </span>
     </label>
     <input class="form-control" id="last_name" name="last_name" type="text" value="{{$employee->last_name}}"/>
    </div>
    <div class="form-group ">
     <label class="control-label " for="phone">
      Telephone #
     </label>
     <input class="form-control" id="phone" name="phone_no" type="text" value="{{$employee->phone_no}}"/>
    </div>
    <div class="form-group">
     <div>
      <button class="btn btn-primary " name="submit" type="submit">
       Submit
      </button>
     </div>
    </div>
   </form>
  </div>
 </div>
</div>
@endsection

@extends('admin_panel.admin_template')

@section('title')
Add Employee
@endsection

@section('admin_content')
<section class="content-header">
  <h1>
    Add New Employee
  </h1>
</section>
<br>
</br>
<div class="container-fluid">
 <div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
   <form method="POST" action="/admin/employee/create">
     <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="form-group ">
     <label class="control-label requiredField" for="first_name">
      First Name
      <span class="asteriskField">
       *
      </span>
     </label>
     <input class="form-control" id="name" name="first_name" type="text"/>
    </div>
    <div class="form-group ">
     <label class="control-label requiredField" for="last_name">
      Last Name
      <span class="asteriskField">
       *
      </span>
     </label>
     <input class="form-control" id="last_name" name="last_name" type="text"/>
    </div>
    <div class="form-group ">
     <label class="control-label " for="phone_no">
      Telephone #
     </label>
     <input class="form-control" id="phone" name="phone_no" type="text"/>
    </div>
    <div class="form-group ">
     <label class="control-label requiredField" for="employee_id">
      User Id
      <span class="asteriskField">
       *
      </span>
     </label>
     <input class="form-control" id="employee_id" name="employee_id" type="text"/>
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

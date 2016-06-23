@extends('admin_panel.admin_template')

@section('title')
Delete Employee?
@endsection

@section('admin_content')

<div class="panel panel-default col-sm-6 col-sm-offset-3" >
  <div class="panel-heading" >
    Are You Sure You Want To Delete Employee?&nbsp&nbsp
    <span class="label label-danger">{{$employee->first_name}}  &nbsp{{$employee->last_name}}</span>
  </div>
  <br>
  <br>
  <div class="panel-body">
    <form method="POST" action"/admin/employee/{{$employee->id}}">
      {{method_field('DELETE')}}
      <fieldset>
        <input class="btn btn-lg btn-danger btn-block" type="submit" value="Delete">
      </fieldset>
    </form>
  </div>
</div>

<style>
  .label {
    font-size: 25px;

  }
</style>

@endsection

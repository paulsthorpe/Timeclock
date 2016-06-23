@extends('admin_panel.admin_template')

@section('title')
All Employees
@endsection

@section('admin_content')
<section class="content-header">
  <h1>
    View All Employees
  </h1>
</section>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>User Id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Phone #</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($employees as $employee)
        <tr>
          <td>{{$employee->id}}</td>
          <td>{{$employee->first_name}}</td>
          <td>{{$employee->last_name}}</td>
          <td>{{$employee->phone_no}}</td>
          <td class="text-center">
            <a class='btn btn-primary btn-xs' href="/admin/employee/edit/{{$employee->id}}">Edit</a>
          </td>
          <td>
            <form action="/admin/employee/{{$employee->id}}" method="POST">
              <input type="hidden" name="_method" value="DELETE">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button class='btn btn-danger btn-xs' type="submit" name="submit">Delete</button>
            </form>
           </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>


@endsection

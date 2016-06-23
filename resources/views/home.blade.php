<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
        <script src="/js/util_scripts.js" type="text/javascript"></script>
        <title>Admin Portal</title>
        <script type="text/javascript">
          $(document).ready(function(){
            $('.alert').delay(6500).fadeOut(500);
          });
        </script>
    </head>
    <body>
      <div class="user_path_container">
        <div class="employee-clock-in">
          <div class="container">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default" >
                  <div class="panel-heading" >
                    Employee Clock In
                  </div>
                  <div class="panel-body">
                    <form method="POST" action="/log_time">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                      <div class="form-group">
                        <input class="form-control" placeholder="Employee Number" name="employee_id" type="text">
                      </div>
                      <input class="btn btn-lg btn-danger btn-block" type="submit" value="Clock In">
                    </fieldset>
                      </form>
                  </div>
              </div>

              </div>
            </div>
          </div>
        </div>
        @if(Session::has('failed'))
          <div class="alert alert-danger col-md-6 col-md-offset-3">{{ Session::get('failed') }}</div>
        @elseif(Session::has('success'))
          <div class="alert alert-success col-md-6 col-md-offset-3">{{ Session::get('success') }}</div>
        @endif
        <div class="admin-log-in">
          <div class="container">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-default" >
                    <div class="panel-heading" >
                      Admin Log In
                    </div>
                    <div class="panel-body">
                      <form action="/admin">
                          <fieldset>
                          <div class="form-group">
                            <input class="form-control" placeholder="User" name="user" type="text">
                        </div>
                        <div class="form-group">
                          <input class="form-control" placeholder="Password" name="password" type="password" value="">
                        </div>
                        <input class="btn btn-lg btn-danger btn-block" type="submit" value="Login">
                        </fieldset>
                      </form>

                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>

    <style media="screen">

      body {
        height: 100vh;
      }

      .admin-log-in{
        margin-top: 20%;
      }

      .employee-clock-in{
        margin-top: 5%;
      }

      .alert {
        position: absolute;
        text-align: center;
      }

    </style>

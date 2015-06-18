<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Authenticate with Laravel 4.2</title>
  <!--llamamos los estilos css de bootstrap-->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <!--assets va a mi carpeta public-->
  {{ HTML::style('assets/css/dash.css') }}
</head>
<body>
  <div class="container">
    <div class="col-md-4 col-md-offset-4">
      {{ Form::open(['url' => 'login', 'autocomplete' => 'off', 'class' => 'form-signin', 'role' => 'form']) }}

      @if(Session::has('error_message'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error_message') }}
      </div>
      @endif

      <h2 class="form-signin-heading">Log in</h2>

      {{ Form::label('username', 'Username', ['class' => 'sr-only']) }}
      {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'usuario', 'autofocus' => '']) }}

      {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
      {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'contraseña']) }}

      <div class="checkbox">
        <label>
          {{ Form::checkbox('remember', true) }} recuerdame
        </label>
      </div>

      {{ Form::submit('iniciar sesion', ['class' => 'btn btn-primary btn-block']) }}

      {{ Form::close() }}
      <a class="btn btn-success" href="{{ action('AuthController@registerUser') }}">crear usuario</a>
      <a class="btn btn-success" href="{{ action('UserController@showPassRecovery') }}">olvida mi contraseña?</a>
    </div>
  </div>
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>

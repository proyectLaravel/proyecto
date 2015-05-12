<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AuthLaravelSimple</title>
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link href="{{ asset('css/dash.css') }}" rel="stylesheet">
  <style>
  @import url(//fonts.googleapis.com/css?family=Lato:700);
  </style>
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">INCAN</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <!--<li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>-->
            <li>
              <div>
                @if (Auth::check())
                  <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav pull-right">
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                          <span class="icon icon-wh i-profile">{{ Auth::user()->username }} </span><span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">

                          <li><a onclick="showView('updateUser','ocultar')">Editar usuario</a></li>
                          <li><a href="{{ action('AuthController@logout') }}">Salir</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                @endif
              <div>
            </li>
            <li><a href="#" onclick="showView('updateUser','ocultar')">Perfil</a></li>
            <li><a href="{{ action('AuthController@logout') }}">Cerrar Sesión</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li  id="liMain" class="active lis">
              <a href="#" onclick="showView('main','ocultar');addClassActive('liMain','lis')">Tareas Asignadas <span class="sr-only">(current)</span></a>
            </li>
            <li id="liAsignarTarea" class="lis" onclick="addClassActive('liAsignarTarea','lis')">
              <a href="#" onclick="showView('asignarTarea','ocultar');addClassActive('liAsignarTarea','lis')">Asignar Tareas</a>
            </li>
            @if (Auth::user()->hasRole('super_admin'))
            <li id="liRegistrarUsuario" class="lis">
              <a href="#" onclick="showView('registrarUsuario','ocultar');addClassActive('liRegistrarUsuario','lis')">Crear Usuarios</a>
            </li>
            <li id="liListarUsuarios" class="lis">
              <a href="#" onclick="showView('listarUsuarios','ocultar');addClassActive('liListarUsuarios','lis')">Listar Usuarios</a>
            </li>
            @endif
            <!--<li><a href="#">favorites</a></li>
            <li><a href="#">Recommended</a></li>-->
          </ul>

        </div>

        <div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar">

          <h1 class="page-header">Historial de Tareas Asignadas</h1>

          @if (Auth::user()->hasRole('super_admin'))
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Area Solicitante </th>
                  <th>Asunto</th>
                  <th>Fecha Entrega</th>
                  <th>Semaforo</th>
                  
                </tr>
              </thead>
              <tbody id="tasksSuperAdmin">
                
              </tbody>
            </table>
          @endif
          @if (Auth::user()->hasRole('admin'))
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Area Solicitante </th>
                  <th>Asunto</th>
                  <th>Fecha Entrega</th>
                  <th>Semaforo</th>
                  
                </tr>
              </thead>
              <tbody id="tasks">
                
              </tbody>
            </table>
          @endif

          

          <h2 class="sub-header">Description</h2>
          <div class="table-responsive">
            <p>This project is a authentication system, bassically you can create users and make crud(create,read,update,delete) on him.
            if you hace questions my tw: @ezeezegg</p>
          </div>
        </div>

        <div id="updateUser" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="col-md-4 col-md-offset-4">
            <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" >

            {{ Form::open(['route' => 'uploadImage', 'method' => 'POST', 'files' => true,'role' => 'form']) }}
              {{ Form::hidden('id', Auth::user()->id ) }}
              {{ Form::file('avatar') }}
              <input type="submit" value="Subir imagen" class="btn btn-success">
            {{ Form::close() }}

            {{ Form::open(['route' => 'updateUser', 'method' => 'POST', 'role' => 'form']) }}

              {{ Form::hidden('id', Auth::user()->id ) }}

              {{ Form::label('first_name', 'FirtsName', ['class' => 'sr-only']) }}
              {{ Form::text('first_name', Auth::user()->first_name , ['class' => 'form-control', 'placeholder' => 'Nombre', 'autofocus' => '']) }}


              {{ Form::label('last_name', 'Last Name', ['class' => 'sr-only']) }}
              {{ Form::text('last_name', Auth::user()->last_name , ['class' => 'form-control', 'placeholder' => 'Apellidos', 'autofocus' => '']) }}

              {{Form::text('email', Auth::user()->email ,['class' => 'form-control', 'placeholder' => 'Email', 'autofocus' => ''])}}

              {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) }}

            <p>
              <input type="submit" value="Actualizar" class="btn btn-success">
            </p>
            {{ Form::close() }}
        </div>
      </div>

      <div id="asignarTarea" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="fluid">
           
            {{ Form::open(['route' => 'asignarTarea', 'method' => 'POST', 'role' => 'form','files' => true]) }}

              {{ Form::hidden('id', Auth::user()->id ) }}
              {{ Form::hidden('estatus', 'enproceso' ) }}

              {{ Form::label('Folio', 'Folio')}}
              {{ Form::text('folio','', ['class' => 'form-control', 'placeholder' => 'Folio', 'autofocus' => '']) }}

              {{ Form::label('Asunto', 'Asunto')}}
              {{ Form::text('asunto', '', ['class' => 'form-control', 'placeholder' => 'Asunto', 'autofocus' => '']) }}

              {{ Form::label('Asignado a', 'asignado a')}}
              <select id="usuarios" name="user_id">
                <option>Please choose car make first</option>
              </select>

              {{ Form::label('Fecha de respuesta', 'fecha respuesta')}}
              
              <!-- id , type, name -->
              {{ Form::custom('datepicker', 'date', 'fecha_respuesta') }}
              </br>
              {{ Form::label('Area Solicitante', 'Area Solicitante')}}
              {{ Form::text('areaSolicitante', '' , ['class' => 'form-control', 'placeholder' => 'Area Solicitante', 'autofocus' => '']) }}
              {{ Form::file('filePdf') }}

            <p>
              <input type="submit" value="Asignar" class="btn btn-success">
            </p>
            {{ Form::close() }}

            {{ Form::open(array('url' => 'uploadpdf','files' => true, 'method' => 'post')) }} 
              
              <p>
              <input type="submit" value="enviar pdf" class="btn btn-success">
            </p>
            {{ Form::close() }} 
        </div>
      </div>
      <!--Vista que te permite crear un usuario-->
      <div id="registrarUsuario" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="fluid">
           
            {{ Form::open(['route' => 'register', 'method' => 'POST', 'role' => 'form']) }}

            {{ Form::label('first_name', 'FirtsName', ['class' => 'sr-only']) }}
            {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'autofocus' => '']) }}


            {{ Form::label('last_name', 'Last Name', ['class' => 'sr-only']) }}
            {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Apellidos', 'autofocus' => '']) }}


            {{ Form::label('username', 'Username', ['class' => 'sr-only']) }}
            {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'autofocus' => '']) }}

            {{Form::text('email', null,['class' => 'form-control', 'placeholder' => 'Email', 'autofocus' => ''])}}
            

            {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña']) }}

            <div class="checkbox">
              <label>
                {{ Form::checkbox('role', '1') }} Es administrador
            </div>

            <p>
              <input type="submit" value="Registrar" class="btn btn-success">
            </p>
            {{ Form::close() }}

        </div>
      </div>

      <!--Vista lista los usuarios-->
      <div id="listarUsuarios" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="fluid">
           
           <table class="table table-hover">
              <thead>
                <tr>
                  <th>id </th>
                  <th>Nombre </th>
                  <th>Email</th>
                  <th>Username</th>
                  <th></th>
                  
                </tr>
              </thead>
              <tbody id="listUsers">
                
              </tbody>
            </table>
            

        </div>
      </div>

      </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('bootstrap-3.2.0/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-3.2.0/js/docs.min.js') }}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{ asset('js/dash.js') }}"></script>

</html>

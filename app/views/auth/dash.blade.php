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
          <a class="navbar-brand" href="#">Mi proyecto</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li>
              <div class="navbar-collapse collapse">
                <div>
                  @if (Auth::check())
                  <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="icon icon-wh i-profile"></span> {{ Auth::user()->username }}  <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">

                        <li><div onclick="showView('updateUser','ocultar')">Editar usuario</li>
                        <li><a href="{{ action('AuthController@logout') }}">Salir</a></li>
                      </ul>
                    </li>
                  </ul>
                  @endif
                </div>
              <div>
            </li>

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
            <li id="lisDash" class="active lis" onclick ="addClassActive('liDash');showView('main','ocultar')"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
            <li id="liBlogh" class="lis" onclick ="addClassActive('liBlog');showView('blog','ocultar')"><a href="#">Blog</a></li>
            <li id="liSocial" class="lis" onclick ="addClassActive('liSocial');showView('social','ocultar')"><a href="#">Social Networking</a></li>
            <li id="liFavor" class="lis" onclick ="addClassActive('liFavor');showView('favor','ocultar')"><a href="#">favorites</a></li>
            <li id="liRecom" class="lis" onclick ="addClassActive('liRecom');showView('recom','ocultar')"><a href="#">Recommended</a></li>
            <li id="liAsigTask" class="lis" onclick ="addClassActive('liAsigTask');showView('asignarTarea','ocultar')"><a href="#">AsigTask</a></li>
          </ul>

        </div>

        <div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar">
          <h1 class="page-header">Dashboard</h1>
          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" >
              <h4>Users signed</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" >
              <h4>More Popular Blogs</h4>
              <span class="text-muted"> else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" >
              <h4>Space Data</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img class="img-circle" src="{{asset(Auth::user()->avatar->url('thumb')) }}" >
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>

          <h2 class="sub-header">Description</h2>
          <div class="table-responsive">
            <p>This project is a authentication system, bassically you can create users and make crud(create,read,update,delete) on him.
            if you hace questions my tw: @ezeezegg</p>
          </div>
        </div>


        </div>
     
      </section>
  

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
              {{ Form::text('first_name', Auth::user()->first_name , ['class' => 'form-control', 'placeholder' => 'Firstname', 'autofocus' => '']) }}


              {{ Form::label('last_name', 'Last Name', ['class' => 'sr-only']) }}
              {{ Form::text('last_name', Auth::user()->last_name , ['class' => 'form-control', 'placeholder' => 'Last Name', 'autofocus' => '']) }}

              {{Form::text('email', Auth::user()->email ,['class' => 'form-control', 'placeholder' => 'Email', 'autofocus' => ''])}}

              {{ Form::label('password', 'Password', ['class' => 'sr-only']) }}
              {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}

            <p>
              <input type="submit" value="Actualizar" class="btn btn-success">
            </p>
            {{ Form::close() }}
        </div>
        </div>





        <div id="blog" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="col-md-4 col-md-offset-4">Blog
          </div> 
        </div>  

        <div id="social" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="col-md-4 col-md-offset-4">social
          </div> 
        </div>

        <div id="favor" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar" style="display:none" >
          <div class="col-md-4 col-md-offset-4">favor
          </div> 
        </div>

        <section id="asignarTarea" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 ocultar spin ocultar" style="display:none" >
          
          <div class="container top">
            <div class="row">
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                      <div class="panel-body">
          
                        @if ($errors->any())
                          <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Por favor corrige los siguentes errores:</strong>
                            <ul>
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                          </div>
                        @endif
                        
                        {{ Form::open(['route' => 'asignTask', 'method' => 'POST', 'role' => 'form','files' => true]) }}
                          {{ Form::hidden('admin_id', Auth::user()->id ) }}
                          
                          </br>
                          {{ Form::label('Folio', 'Folio')}}
                          {{ Form::text('folio','', ['id' => 'folio', 'class' => 'form-control', 'placeholder' => 'Folio', 'autofocus' => '']) }}
                          </br>
                          {{ Form::label('Oficio Referencia', 'Oficio Referencia')}}
                          {{ Form::text('oficio_referencia','', ['id' => 'oficio_referencia', 'class' => 'form-control', 'placeholder' => 'Oficio Referencia', 'autofocus' => '']) }}
                          </br>
                          {{ Form::label('Descripcion', 'Descripcion')}}
                          {{ Form::text('descripcion', '', ['id' => 'descripcion', 'class' => 'form-control', 'placeholder' => 'Asunto', 'autofocus' => '']) }}
                          </br>
                          <p class="center">
                            <input type="submit" value="Asignar Tarea" class="btn btn-success">
                          </p>
                        {{ Form::close() }}
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
       
        </section>
  



      </div>

      </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('bootstrap-3.2.0/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-3.2.0/js/docs.min.js') }}"></script>
<script src="{{ asset('js/dash.js') }}"></script>

</html>

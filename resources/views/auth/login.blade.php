<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">

  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/iniciosesion.css') }}">
  <title>Formulario Login</title>
</head>

<body>

  <!-- Formularios -->
  <div class="contenedor-formularios">
    <!-- Título del formulario -->
    <h1>Iniciar Sesión</h1>

    <!-- Contenido del Formulario de Iniciar Sesión -->
    <div id="iniciar-sesion">
      <div class="form-header">
        <img src="{{ asset('storage/logo-mag.png') }}" alt="Ministerio de Agricultura y Ganadería">
      </div>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        @if($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @elseif(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="contenedor-input">
          <label for="usuario">Usuario <span class="req">*</span></label>
          <input id="usuario" type="text" name="usuario" required="required">
        </div>
    
        <div class="contenedor-input">
          <label for="login_password">Contraseña <span class="req">*</span></label>
          <input id="login_password" type="password" name="password" required="required">
        </div>
        
        <input type="submit" class="button button-block" value="Iniciar Sesión">
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- importar js -->
  <script src="{{ asset('js/iniciosesion.js') }}"></script>
</body>

</html>

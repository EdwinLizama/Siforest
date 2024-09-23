<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/iniciosesion.css') }}">
  <title>Iniciar Sesión | SIFOREST</title>
</head>

<body>

  <!-- Contenedor del formulario -->
  <div class="contenedor-formulario">
    <div class="form-header">
      <h1>SIFOREST</h1>
      <p>Bienvenido, por favor inicia sesión para continuar</p>
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
      
      <!-- Campos del formulario -->
      <div class="contenedor-input">
        <label for="usuario">Usuario</label>
        <input id="usuario" type="text" name="usuario" required>
      </div>
      
      <div class="contenedor-input">
        <label for="login_password">Contraseña</label>
        <input id="login_password" type="password" name="password" required>
      </div>
      
      <!-- Botón para iniciar sesión -->
      <input type="submit" class="button button-block" value="Iniciar Sesión">
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('js/iniciosesion.js') }}"></script>
</body>

</html>

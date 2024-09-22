<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway|Ubuntu" rel="stylesheet">

  <!-- Estilos -->
  <link rel="stylesheet" href="{{ asset('css/iniciosesion.css') }}">
  <title>Formulario Login y Registro de Usuarios</title>
</head>

<body>

  <!-- Formularios -->
  <div class="contenedor-formularios">
    <!-- Links de los formularios -->
    <ul class="contenedor-tabs">
      <li class="tab tab-segunda active"><a href="#iniciar-sesion">Iniciar Sesión</a></li>
      <li class="tab tab-primera"><a href="#registrarse">Registrarse</a></li>
    </ul>

    <!-- Contenido de los Formularios -->
    <div class="contenido-tab">
      <!-- Iniciar Sesion -->
      <div id="iniciar-sesion">
        <div class="form-header">
          <img src="{{ asset('storage/logo-mag.png') }}" alt="Ministerio de Agricultura y Ganadería">
        </div>
        <h1>Iniciar Sesión</h1>
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
          <p class="forgot"><a href="#">¿Se te olvidó la contraseña?</a></p>
          <input type="submit" class="button button-block" value="Iniciar Sesión">
        </form>
      </div>

      <!-- Registrarse -->
      <div id="registrarse">
        <h1>Registrarse</h1>
        <form action="{{ route('register') }}" method="POST" onsubmit="return validatePassword()">
          @csrf
          @if ($errors->any())
              <div class="alert alert-danger">
                  {{ $errors->first() }}
              </div>
          @endif
          <div class="contenedor-input">
              <label for="name">Nombre <span class="req">*</span></label>
              <input id="name" type="text" name="name" required="required">
          </div>
          <div class="contenedor-input">
              <label for="apellido">Apellido <span class="req">*</span></label>
              <input id="apellido" type="text" name="apellido" required="required">
          </div>
          <div class="contenedor-input">
              <label for="usuario">Nombre de Usuario <span class="req">*</span></label>
              <input id="usuario" type="text" name="usuario" required="required"> <!-- Añadir campo 'usuario' -->
          </div>
          <div class="contenedor-input">
              <label for="telefono">Teléfono <span class="req">*</span></label>
              <input id="telefono" type="text" name="telefono" required="required"> <!-- Añadir campo 'telefono' -->
          </div>
          <div class="contenedor-input">
              <label for="email">Correo Electrónico <span class="req">*</span></label>
              <input id="email" type="email" name="email" required="required">
          </div>
          <div class="contenedor-input">
              <label for="region">Región <span class="req">*</span></label>
              <select id="region" name="region" required="required">
                  <option value="">Selecciona una región</option>
                  <option value="1">Región 1</option>
                  <option value="2">Región 2</option>
                  <option value="3">Región 3</option>
                  <option value="4">Región 4</option>
              </select>
          </div>
          <div class="contenedor-input">
              <label for="register_password">Contraseña <span class="req">*</span></label>
              <input id="register_password" type="password" name="password" required="required">
          </div>
          <div class="contenedor-input">
              <label for="register_password_confirmation">Confirmar Contraseña <span class="req">*</span></label>
              <input id="register_password_confirmation" type="password" name="password_confirmation" required="required">
          </div>
          <input type="submit" class="button button-block" value="Registrarse">
      </form>
      
      
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- importar js -->
  <script src="{{ asset('js/iniciosesion.js') }}"></script>
  <script>
    function validatePassword() {
      var password = document.getElementById("register_password").value;
      var confirmPassword = document.getElementById("register_password_confirmation").value;
      if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden.");
        return false;
      }
      return true;
    }
  </script>
</body>

</html>

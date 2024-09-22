<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Token CSRF -->
    <title>Crear Usuario - Admin Dashboard</title>
    
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/crear_usuario.css') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">SIFOREST</a>
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3">Bienvenido, {{ Auth::user()->name }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="form-container">
                    <h2 class="form-title text-center mb-4">Crear Nuevo Usuario</h2>
                    
                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                    
                        <div class="input-group">
                            <span class="form-icon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="input-group">
                            <span class="form-icon"><i class="fas fa-user-tag"></i></span>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="{{ old('apellido') }}" required>
                            @error('apellido')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="input-group">
                            <span class="form-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="input-group">
                            <span class="form-icon"><i class="fas fa-phone-alt"></i></span>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" required>
                            @error('telefono')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="input-group">
                            <span class="form-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" id="region" name="region" placeholder="Región" value="{{ old('region') }}" required>
                            @error('region')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <button type="submit" class="btn btn-primary mt-4">Crear Usuario</button>
                    
                        <p class="help-text text-center mt-3">
                            Asegúrese de que todos los campos estén correctos antes de enviar.
                        </p>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

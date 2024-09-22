<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard_user.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos de FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .profile-header {
            background-color: #343a40;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .profile-header a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }

        .form-control {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 12px;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #4285F4;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #357ae8;
        }

        .btn-home {
            background-color: #6c757d;
            padding: 8px 16px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-home:hover {
            background-color: #5a6268;
            text-decoration: none;
        }

        .alert-danger, .alert-success {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header con botón para regresar al home -->
        <div class="profile-header">
            <h2>Cambiar Contraseña</h2>
            <a href="{{ route('user.dashboard') }}" class="btn-home"><i class="fas fa-arrow-left"></i> Regresar al Home</a>
        </div>

        <!-- Mostrar mensajes de éxito o error -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Formulario para cambiar contraseña -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('user.cambiar-contrasena.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cambiar Contraseña</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
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
    </style>
</head>

<body>

    <div class="container">
        <!-- Header con botón para regresar al home -->
        <div class="profile-header">
            <h2>Editar Perfil</h2>
            <a href="{{ route('user.dashboard') }}" class="btn-home"><i class="fas fa-arrow-left"></i> Regresar al Home</a>
        </div>

        <!-- Mostrar mensaje de éxito -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- Formulario para editar perfil -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('user.perfil.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $user->telefono }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

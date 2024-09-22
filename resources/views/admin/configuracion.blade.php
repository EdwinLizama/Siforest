<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración del Administrador</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link id="theme-stylesheet" rel="stylesheet" href="{{ asset('css/light-mode.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Configuración del Administrador</h2>

        <!-- Editar perfil -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Editar Perfil
            </div>
            <div class="card-body">
                <form action="{{ route('admin.perfil.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>

        <!-- Cambiar contraseña -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                Cambiar Contraseña
            </div>
            <div class="card-body">
                <form action="{{ route('admin.password.update') }}" method="POST">
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
                    <button type="submit" class="btn btn-warning">Cambiar Contraseña</button>
                </form>
            </div>
        </div>



        <!-- Modo oscuro -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                Preferencias de Apariencia
            </div>
            <div class="card-body">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                    <label class="form-check-label" for="darkModeSwitch">Modo Oscuro</label>
                </div>
            </div>
        </div>

        <!-- Botón de regresar -->
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Regresar al Home</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para modo oscuro -->
    <script>
        const darkModeSwitch = document.getElementById('darkModeSwitch');
        const stylesheet = document.getElementById('theme-stylesheet');

        // Verificar si el modo oscuro está activo en el almacenamiento local
        if (localStorage.getItem('darkMode') === 'enabled') {
            darkModeSwitch.checked = true;
            stylesheet.href = '{{ asset("css/dark-mode.css") }}';
        }

        darkModeSwitch.addEventListener('change', () => {
            if (darkModeSwitch.checked) {
                stylesheet.href = '{{ asset("css/dark-mode.css") }}';
                localStorage.setItem('darkMode', 'enabled');
            } else {
                stylesheet.href = '{{ asset("css/light-mode.css") }}';
                localStorage.setItem('darkMode', 'disabled');
            }
        });
    </script>
</body>
</html>

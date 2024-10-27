<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">SIFOREST</a>

            <!-- User Info and Logout -->
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3">Bienvenido, {{ Auth::user()->name }}</span>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="btn btn-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div id="sidebar" class="col-md-3 sidebar">
                <div class="sidebar-header">
                    <h2 class="text-white text-center py-4">Admin Dashboard</h2>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="{{ route('admin.usuarios') }}"><i
                                class="fas fa-users"></i> Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.usuarios.create') }}"><i
                                class="fas fa-user-plus"></i> Crear Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.documentos') }}"><i class="fas fa-file-alt"></i> Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('admin.config')}}"><i class="fas fa-cog"></i> Configuración</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('admin.solicitudes')}}">
                            <i class="fas fa-file-alt"></i> Solicitudes
                        </a>
                    </li>
                    

                </ul>

                <!-- Logout -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="nav-link text-white logout"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </a>

                <!-- Pestaña para ocultar/mostrar el sidebar -->
                <div class="toggle-btn" onclick="toggleSidebar()">
                    <i id="toggle-icon" class="fas fa-chevron-left"></i>
                </div>
            </div>

            <!-- Main content -->
            <div id="main-content" class="col main-content">
                <div class="row justify-content-center">
                    <!-- Stats Cards -->
                    <div class="container my-5">
                        <div class="row justify-content-center" style="width: 70%; margin: 0 auto;">
                            <div class="col-md-4">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><i class="fas fa-users"></i> Usuarios Activos</h5>
                                        <p class="card-text text-center">{{ $usuariosActivos }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card text-white bg-success mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><i class="fas fa-file-alt"></i> Documentos Subidos</h5>
                                        <p class="card-text text-center">{{ $documentosSubidos }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card text-white bg-info mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><i class="fas fa-database"></i> Tamaño Total de Archivos</h5>
                                        <p class="card-text text-center">{{ $totalSizeInMB }} MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="container my-5">
                        <div class="card mx-auto" style="width: 70%;">
                            <div class="card-header text-center">
                                Actividad Reciente
                            </div>
                            <div class="card-body text-center">
                                <ul class="activity-list">
                                    @foreach($actividadesRecientes as $actividad)
                                        <li>{{ $actividad['mensaje'] }} - {{ $actividad['fecha'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para manejar el comportamiento del sidebar -->
    <script>
        let sidebarVisible = true;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleIcon = document.getElementById('toggle-icon');
            const header = document.querySelector('header');

            if (sidebarVisible) {
                // Ocultar sidebar
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
                header.classList.remove('sidebar-visible');
                toggleIcon.classList.remove('fa-chevron-left');
                toggleIcon.classList.add('fa-chevron-right');
            } else {
                // Mostrar sidebar
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
                header.classList.add('sidebar-visible');
                toggleIcon.classList.remove('fa-chevron-right');
                toggleIcon.classList.add('fa-chevron-left');
            }
            sidebarVisible = !sidebarVisible;
        }
    </script>
</body>

</html>

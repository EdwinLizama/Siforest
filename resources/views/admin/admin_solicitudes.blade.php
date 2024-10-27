<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes - Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/solicitudes_admin.css') }}">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIFOREST</a>
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3">Bienvenido, {{ Auth::user()->name }}</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="btn btn-danger btn-sm"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">

            <div id="sidebar" class="col-md-3 sidebar bg-dark text-white">
                <div class="sidebar-header text-center py-4">
                    <h2>Admin Dashboard</h2>
                </div>
                <ul class="nav flex-column p-3">
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ request()->is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ request()->is('admin/usuarios*') ? 'active' : '' }}" href="{{ route('admin.usuarios') }}">
                            <i class="fas fa-users"></i> Usuarios
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ request()->is('admin/documentos*') ? 'active' : '' }}" href="{{ route('admin.documentos') }}">
                            <i class="fas fa-file-alt"></i> Documentos
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ request()->is('admin/solicitudes*') ? 'active' : '' }}" href="{{ route('admin.solicitudes') }}">
                            <i class="fas fa-folder-open"></i> Solicitudes
                        </a>
                    </li>
                    <li class="nav-item mb-3">
                        <a class="nav-link text-white {{ request()->is('admin/mapa*') ? 'active' : '' }}" href="{{ route('admin.solicitudes.mapa') }}">
                            <i class="fas fa-map-marker-alt"></i> Mapa de Solicitudes
                        </a>
                    </li>
                    <!-- Logout -->
                    <li class="nav-item mb-3">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a class="nav-link text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
            

            <!-- Main Content -->
            <div id="main-content" class="col-md-9 main-content">
                <div class="container mt-4 pt-3">
                    <h1 class="mb-3">Gestión de Solicitudes</h1>

                    <!-- Estadísticas -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-2" style="cursor: pointer;" data-bs-toggle="tab"
                                data-bs-target="#pendientes">
                                <div class="card-header">Pendientes</div>
                                <div class="card-body">
                                    <h5>{{ $totalPendientes }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-2" style="cursor: pointer;" data-bs-toggle="tab"
                                data-bs-target="#aprobadas">
                                <div class="card-header">Aprobadas</div>
                                <div class="card-body">
                                    <h5>{{ $totalAprobadas }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-2" style="cursor: pointer;" data-bs-toggle="tab"
                                data-bs-target="#rechazadas">
                                <div class="card-header">Rechazadas</div>
                                <div class="card-body">
                                    <h5>{{ $totalRechazadas }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Gráfico de Solicitudes -->
                    <div class="container my-3">
                        <canvas id="solicitudesChart"></canvas>
                    </div>

                    <!-- Barra de búsqueda 
                    <form action="" method="GET" class="my-3">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Buscar por nombre o estado...">
                            <button type="submit" class="btn btn-outline-primary btn-sm">Buscar</button>
                        </div>
                    </form>-->

                    <!-- Pestañas (Tabs) para los diferentes estados de las solicitudes -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#pendientes">Pendientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#aprobadas">Aprobadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#rechazadas">Rechazadas</a>
                        </li>
                    </ul>

                    <!-- Contenido de las pestañas -->
                    <div class="tab-content mt-3">
                        <!-- Solicitudes pendientes (en revisión) -->
                        <div id="pendientes" class="tab-pane fade show active">
                            <h4>Solicitudes Pendientes</h4>
                            @if ($solicitudesPendientes->isEmpty())
                                <div class="alert alert-info">
                                    No hay solicitudes pendientes.
                                </div>
                            @else
                                <div class="card shadow-sm">
                                    <div class="card-header bg-primary text-white">Solicitudes en Revisión</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre del Solicitante</th>
                                                    <th>Fecha de Solicitud</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($solicitudesPendientes as $solicitud)
                                                    <tr>
                                                        <td>{{ $solicitud->id }}</td>
                                                        <td>{{ $solicitud->nombre }}</td>
                                                        <td>{{ $solicitud->fecha_solicitud }}</td>
                                                        <td>
                                                            <form action="{{ route('admin.show', $solicitud->id) }}"
                                                                method="GET" class="d-inline">
                                                                <button type="submit" class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-eye"></i> Ver
                                                                </button>
                                                            </form>

                                                            <form
                                                                action="{{ route('admin.solicitudes.aprobar', $solicitud->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check"></i> Aprobar
                                                                </button>
                                                            </form>
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="mostrarMotivoRechazo({{ $solicitud->id }})">
                                                                <i class="fas fa-times"></i> Rechazar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Solicitudes aprobadas -->
                        <div id="aprobadas" class="tab-pane fade">
                            <h4>Solicitudes Aprobadas</h4>
                            @if ($solicitudesAprobadas->isEmpty())
                                <div class="alert alert-info">
                                    No hay solicitudes aprobadas.
                                </div>
                            @else
                                <div class="card shadow-sm">
                                    <div class="card-header bg-success text-white">Solicitudes Aprobadas</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre del Solicitante</th>
                                                    <th>Fecha de Solicitud</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($solicitudesAprobadas as $solicitud)
                                                    <tr>
                                                        <td>{{ $solicitud->id }}</td>
                                                        <td>{{ $solicitud->nombre }}</td>
                                                        <td>{{ $solicitud->fecha_solicitud }}</td>
                                                        <td>
                                                            <form action="{{ route('admin.show', $solicitud->id) }}"
                                                                method="GET" class="d-inline">
                                                                <button type="submit" class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-eye"></i> Ver
                                                                </button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <!--eliminar solicitud-->
                                                            <form action="{{ route('admin.solicitudes.eliminar', $solicitud->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Solicitudes rechazadas -->
                        <div id="rechazadas" class="tab-pane fade">
                            <h4>Solicitudes Rechazadas</h4>
                            @if ($solicitudesRechazadas->isEmpty())
                                <div class="alert alert-info">
                                    No hay solicitudes rechazadas.
                                </div>
                            @else
                                <div class="card shadow-sm">
                                    <div class="card-header bg-danger text-white">Solicitudes Rechazadas</div>
                                    <div class="card-body">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre del Solicitante</th>
                                                    <th>Fecha de Solicitud</th>
                                                    <th>Motivo del Rechazo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($solicitudesRechazadas as $solicitud)
                                                    <tr>
                                                        <td>{{ $solicitud->id }}</td>
                                                        <td>{{ $solicitud->nombre }}</td>
                                                        <td>{{ $solicitud->fecha_solicitud }}</td>
                                                        <td>{{ $solicitud->motivo_rechazo }}</td>
                                                        <td>
                                                            <!--eliminar solicitud-->
                                                            <form action="{{ route('admin.solicitudes.eliminar', $solicitud->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para motivo de rechazo -->
    <div class="modal fade" id="modal-rechazo" tabindex="-1" aria-labelledby="rechazoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rechazoLabel">Rechazar Solicitud</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rechazar-form" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="motivo_rechazo">Motivo de Rechazo</label>
                            <textarea class="form-control" id="motivo_rechazo" name="motivo_rechazo" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3">Rechazar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para manejar el modal dinámicamente -->
    <script>
        function mostrarMotivoRechazo(id) {
            const form = document.getElementById('rechazar-form');
            form.action = 'http://localhost/DSI/Siforest/public/admin/solicitudes/rechazar/' + id;
            const modal = new bootstrap.Modal(document.getElementById('modal-rechazo'));
            modal.show();
        }
    </script>

    <!-- Script de Chart.js para el gráfico -->
    <script>
        var ctx = document.getElementById('solicitudesChart').getContext('2d');
        var solicitudesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Pendientes', 'Aprobadas', 'Rechazadas'],
                datasets: [{
                    label: 'Número de Solicitudes',
                    data: [{{ $totalPendientes }}, {{ $totalAprobadas }}, {{ $totalRechazadas }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>

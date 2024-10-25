<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Formularios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/solicitud.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIFOREST</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Cerrar Sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h1>Lista de Formularios</h1>

        <!-- Barra de búsqueda y filtros -->
        <form action="{{ route('solicitudes') }}" method="GET">
        <div class="row mb-4">
            <div class="col-md-4">
                <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha de inicio" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha de fin" value="{{ request('fecha_fin') }}">
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre" value="{{ request('search') }}">
            </div>
            <div class="d-flex justify-content-between mb-3">
                <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                <button type="button" class="btn btn-secondary" onclick="limpiarBusqueda()">Restablecer</button>
            </div>    
        </div>
        </form>

        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary mb-3" onclick="window.location.href='{{ route('formulario.index') }}'">Crear Solicitud</button>

        </div>

        <!-- Tabla de formularios con scroll -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Tus Formularios</h3>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: scroll;">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Nº Expediente</th>
                            <th>Fecha de Solicitud</th>
                            <th>Nombre del Solicitante</th>
                            <th>Region</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solicitudes as $solicitud)
                            <tr>
                                <td>{{ $solicitud->id }}</td>
                                <td>{{ $solicitud->expediente_r }}-{{ $solicitud->expediente_ano }}</td>
                                <td>{{ $solicitud->fecha_solicitud }}</td>
                                <td>{{ $solicitud->nombre }}</td>
                                <td>{{ $solicitud->region }}</td>

                                <td>
                                    @if($solicitud->estado == 'en revision')
                                        <span class="badge bg-warning text-dark">En Revisión</span>
                                    @elseif($solicitud->estado == 'en proceso')
                                        <span class="badge bg-primary text-light">En Proceso</span>
                                    @elseif($solicitud->estado == 'rechazado')
                                        <span class="badge bg-danger text-light">Rechazado</span>
                                    @elseif($solicitud->estado == 'finalizado')
                                        <span class="badge bg-success text-light">Finalizado</span>
                                    @endif
                                </td>
                                <td>
                                    @if($solicitud->estado == 'en revision')
                                        <a href="{{ route('solicitud.show', $solicitud) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <form action="{{ route('solicitud.destroy', $solicitud) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    @elseif($solicitud->estado == 'en proceso' || 'finalizado')
                                        <a href="" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="" class="btn btn-warning btn-sm">
                                            <i class="fas fa-print"></i> Imprimir
                                        </a>
                                        <a href="" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>

                                        <form action="" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Mensaje si no hay resultados -->
                <p id="noResultsMessage" class="text-center" style="display: none;">No se encontraron coincidencias.</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function limpiarBusqueda() {
            window.location.href = '';  // Simplemente recarga la página
        }
    </script>
</body>
</html>

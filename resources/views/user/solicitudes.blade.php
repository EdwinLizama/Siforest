<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Formularios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/solicitud.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIFOREST</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                    <input type="date" name="fecha_inicio" class="form-control" placeholder="Fecha de inicio"
                        value="{{ request('fecha_inicio') }}">
                </div>
                <div class="col-md-4">
                    <input type="date" name="fecha_fin" class="form-control" placeholder="Fecha de fin"
                        value="{{ request('fecha_fin') }}">
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre"
                        value="{{ request('search') }}">
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                    <button type="button" class="btn btn-secondary" onclick="limpiarBusqueda()">Restablecer</button>
                </div>
            </div>
        </form>

        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-primary mb-3"
                onclick="window.location.href='{{ route('formulario.index') }}'">Crear Solicitud</button>
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
                            <th>Departamento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($solicitudes->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No se encontraron formularios.</td>
                            </tr>
                        @else
                            @foreach($solicitudes as $solicitud)
                            <tr>
                                <td>{{ $solicitud->id }}</td>
                                <td>{{ $solicitud->expediente_r }}-{{ $solicitud->expediente_ano }}</td>
                                <td>{{ $solicitud->fecha_solicitud }}</td>
                                <td>{{ $solicitud->nombre }}</td>
                                <td>{{ $solicitud->departamento_solicitante }}</td>
                                <td>
                                    @if($solicitud->estado == 'en revision')
                                        <span class="badge bg-warning text-dark">En Revisión</span>
                                    @elseif($solicitud->estado == 'rechazado')
                                        <span class="badge bg-danger text-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Motivo: {{ $solicitud->motivo_rechazo }}">
                                            Rechazado <i class="fas fa-info-circle"></i>
                                        </span> <!-- Tooltip para el motivo -->
                                    @elseif($solicitud->estado == 'aprobado')
                                        <span class="badge bg-success text-light">Aprobado</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Ver e imprimir siempre disponibles -->
                                    <a href="{{ route('solicitud.show', $solicitud) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('solicitud.pdf', $solicitud) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-print"></i> Imprimir
                                    </a>
                    
                                    @if($solicitud->estado == 'en revision')
                                        <!-- Si está en revisión, no permitir editar ni eliminar -->
                                        <span class="text-muted">Edición no disponible</span>
                                    @elseif($solicitud->estado == 'rechazado')
                                        <!-- Si está rechazada, permitir editar y eliminar -->
                                        <a href="{{ route('solicitud.edit', $solicitud) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-edit"></i> Editar y reenviar
                                        </a>
                                        <form action="{{ route('solicitud.destroy', $solicitud) }}" method="POST" class="d-inline-block delete-confirm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>
                                    @elseif($solicitud->estado == 'aprobado')
                                        <!-- Si está aprobada, solo permitir ver e imprimir, no editar ni eliminar -->
                                        <span class="text-muted">No se puede editar ni eliminar</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Inicializar los tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Mostrar la alerta de éxito cuando se elimina, actualiza o crea una solicitud
        @if(session('deleted'))
        Swal.fire({
            icon: 'success', // Cambié 'deleted' a 'success', ya que 'deleted' no es un ícono válido de SweetAlert
            title: '¡Eliminado!',
            text: '{{ session('deleted') }}',
            timer: 3000,
            showConfirmButton: false
        }).then(function() {
            // Limpiar la sesión después de mostrar la alerta
            window.history.replaceState(null, null, window.location.href);
        });
        @endif
    
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        }).then(function() {
            // Limpiar la sesión después de mostrar la alerta
            window.history.replaceState(null, null, window.location.href);
        });
        @endif
    
        @if(session('update'))
        Swal.fire({
            icon: 'success',
            title: '¡Actualizado!',
            text: '{{ session('update') }}',
            timer: 3000,
            showConfirmButton: false
        }).then(function() {
            // Limpiar la sesión después de mostrar la alerta
            window.history.replaceState(null, null, window.location.href);
        });
        @endif
    
        // Confirmar antes de eliminar con SweetAlert
        $('.delete-confirm').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
    
    <script>
        function limpiarBusqueda() {
            window.location.href = '{{ route("solicitudes") }}';
        }
    </script>

</body>

</html>

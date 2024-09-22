<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/dashboard_user.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIFOREST</a>
            <div class="d-flex align-items-center ms-auto">
                <span class="text-white me-3">Bienvenido, {{ Auth::user()->name }}</span>
                <a href="{{ route('user.perfil') }}" class="btn btn-light me-2">Perfil</a>
                <a href="{{ route('user.cambiar-contrasena') }}" class="btn btn-light me-2">Cambiar Contraseña</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" class="btn btn-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            </div>
        </div>
    </header>

    <div class="container mt-5 pt-5">
        <!-- Tarjetas de resumen -->
        <div class="row">
            <div class="col-md-4">
                <div class="card card-stats text-white bg-primary mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Documentos en el sistema:</h5>
                            <i class="fas fa-file-upload fa-2x"></i>
                        </div>
                        <p class="card-text display-4">{{ $totalDocumentos }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barra de búsqueda y filtros -->
        <div class="row mb-4">
            <div class="col-md-6">
                <input type="text" id="buscarDocumento" class="form-control"
                    placeholder="Buscar por nombre de documento...">
            </div>
            <div class="col-md-3">
                <input type="date" id="filtrarFecha" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary" onclick="buscarDocumento()">Buscar</button>
                <button class="btn btn-secondary" onclick="limpiarBusqueda()">Limpiar</button>
            </div>
        </div>

        <!-- Tabla de documentos con scroll -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Tus Documentos</h3>
                <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload"></i> Subir Nuevo Documento
                </a>
            </div>
            <div class="card-body" style="max-height: 400px; overflow-y: scroll;"> <!-- Aquí se aplica el scroll -->
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Nombre del Documento</th>
                            <th>Descripción</th>
                            <th>Región</th>
                            <th>Fecha de Subida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="documentosTable">
                        @foreach ($documentos as $documento)
                            <tr>
                                <td>{{ $documento->nombre_documento }}</td>
                                <td>{{ $documento->descripcion }}</td>
                                <td>{{ $documento->region }}</td>
                                <td>{{ $documento->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('documentos.download', $documento->id) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $documento->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                    <!-- Botón para ver el documento en un modal -->
                                    <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#verDocumentoModal-{{ $documento->id }}">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
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

    <!-- Modal para subir documento -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Subir Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Documento</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Subir Archivo (.doc, .pdf)</label>
                            <input type="file" class="form-control" id="archivo" name="archivo"
                                accept=".doc,.pdf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Documento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para editar documento -->
    <div class="modal fade" id="editModal-{{ $documento->id }}" tabindex="-1"
        aria-labelledby="editModalLabel-{{ $documento->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel-{{ $documento->id }}">Editar Documento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('documentos.update', $documento->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre_documento" class="form-label">Nombre del Documento</label>
                            <input type="text" class="form-control" id="nombre_documento" name="nombre"
                                value="{{ $documento->nombre_documento }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $documento->descripcion }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Cambiar Archivo (.doc, .pdf)</label>
                            <input type="file" class="form-control" id="archivo" name="archivo"
                                accept=".doc,.pdf">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function buscarDocumento() {
            const searchValue = document.getElementById('buscarDocumento').value.toLowerCase();
            const filterDate = document.getElementById('filtrarFecha').value;
            const rows = document.querySelectorAll('#documentosTable tr');
            let hasResults = false;

            rows.forEach(row => {
                const nombre = row.cells[0].innerText.toLowerCase();
                const fecha = row.cells[3].innerText.split('/').reverse().join(
                    '-'); // Convertir dd/mm/yyyy a yyyy-mm-dd

                const nombreMatch = nombre.includes(searchValue);
                const fechaMatch = filterDate === '' || fecha === filterDate;

                if (nombreMatch && fechaMatch) {
                    row.style.display = '';
                    hasResults = true;
                } else {
                    row.style.display = 'none';
                }
            });

            document.getElementById('noResultsMessage').style.display = hasResults ? 'none' : 'block';
        }

        function limpiarBusqueda() {
            document.getElementById('buscarDocumento').value = '';
            document.getElementById('filtrarFecha').value = '';
            buscarDocumento();
        }
    </script>
</body>

</html>

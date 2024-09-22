<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Documentos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-back {
            margin-bottom: 20px;
        }
        .modal-header {
            background-color: #007bff;
            color: #fff;
        }
        .btn-close {
            color: #fff;
        }
        .btn-upload {
            background-color: #28a745;
            color: #fff;
        }
        .btn-upload:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <!-- Botón de regresar a Home -->
    <div class="container">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-back">
            <i class="fas fa-arrow-left"></i> Regresar a Home
        </a>
    </div>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Administración de Documentos</h2>

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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Todos los Documentos</h3>
                <button class="btn btn-upload" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-upload"></i> Subir Nuevo Documento
                </button>
            </div>

            <div class="card-body">
                <table id="documentosTable" class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre del Documento</th>
                            <th>Descripción</th>
                            <th>Región</th>
                            <th>Subido por</th>
                            <th>Fecha de Subida</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $documento)
                            <tr>
                                <td>{{ $documento->nombre_documento }}</td>
                                <td>{{ $documento->descripcion }}</td>
                                <td>{{ $documento->region }}</td>
                                <td>{{ $documento->nombreusuario }}</td>
                                <td>{{ $documento->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('documentos.download', $documento->id) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal-{{ $documento->id }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal para editar documento -->
                            <div class="modal fade" id="editModal-{{ $documento->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $documento->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-{{ $documento->id }}">Editar Documento</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="nombre_documento" class="form-label">Nombre del Documento</label>
                                                    <input type="text" class="form-control" id="nombre_documento" name="nombre" value="{{ $documento->nombre_documento }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="descripcion" class="form-label">Descripción</label>
                                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $documento->descripcion }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="archivo" class="form-label">Cambiar Archivo (.doc, .pdf)</label>
                                                    <input type="file" class="form-control" id="archivo" name="archivo" accept=".doc,.pdf">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <!-- Mensaje cuando no se encuentran resultados -->
                <div id="noResultsMessage" style="display:none;" class="alert alert-warning">
                    No se encontraron documentos que coincidan con la búsqueda.
                </div>
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
                    <form action="{{ route('admin.documentos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre_documento" class="form-label">Nombre del Documento</label>
                            <input type="text" class="form-control" id="nombre_documento" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Subir Archivo (.doc, .pdf)</label>
                            <input type="file" class="form-control" id="archivo" name="archivo" accept=".doc,.pdf" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Documento</button>
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
            const rows = document.querySelectorAll('#documentosTable tbody tr');
            let hasResults = false;

            rows.forEach(row => {
                const nombre = row.cells[0].innerText.toLowerCase();
                const fecha = row.cells[4].innerText.split('/').reverse().join('-'); // Convertir dd/mm/yyyy a yyyy-mm-dd

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

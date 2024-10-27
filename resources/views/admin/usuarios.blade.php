<!-- resources/views/admin/usuarios.blade.php -->
@extends('layouts.app')

@section('title', 'Usuarios - Admin Dashboard')

@section('content')

    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Gestión de Usuarios</h2>

        <!-- Barra de búsqueda -->
        <div class="mb-4 d-flex justify-content-center">
            <input type="text" class="form-control search-input" id="searchUser"
                placeholder="Buscar usuario por nombre o email...">
            <button class="btn btn-primary ms-2" id="btnSearch">Buscar</button>
            <button class="btn btn-secondary ms-2" id="btnResetSearch">Limpiar</button>
        </div>

        <!-- Tabla de usuarios -->
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Región</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    @foreach ($usuarios as $usuario)
                        <tr data-id="{{ $usuario->id }}">
                            <td>{{ $usuario->name }} {{ $usuario->apellido }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->region }}</td>
                            <td>
                                <form method="POST" action="{{ route('usuarios.cambiar-rol', $usuario->id) }}"
                                    id="roleForm-{{ $usuario->id }}">
                                    @csrf
                                    @method('POST')
                                    <select class="form-select role-select" data-id="{{ $usuario->id }}" name="rol">
                                        <option value="user" {{ $usuario->rol == 'user' ? 'selected' : '' }}>Usuario
                                        </option>
                                        <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>
                                            Administrador</option>
                                    </select>
                                    <button type="submit" id="saveRoleChanges-{{ $usuario->id }}"
                                        class="btn btn-success mt-2" style="display:none;">Guardar cambios</button>
                                </form>
                            </td>
                            <td>
                                <!-- Botones de edición y eliminación -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal-{{ $usuario->id }}">Editar</button>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal para edición -->
                        <div class="modal fade" id="editModal-{{ $usuario->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel-{{ $usuario->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel-{{ $usuario->id }}">Editar Usuario</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="mb-3">
                                                <label for="editName" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="editName" name="name"
                                                    value="{{ $usuario->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editApellido" class="form-label">Apellido</label>
                                                <input type="text" class="form-control" id="editApellido" name="apellido"
                                                    value="{{ $usuario->apellido }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email"
                                                    value="{{ $usuario->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editTelefono" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="editTelefono" name="telefono"
                                                    value="{{ $usuario->telefono }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editRegion" class="form-label">Región</label>
                                                <input type="text" class="form-control" id="editRegion" name="region"
                                                    value="{{ $usuario->region }}" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Búsqueda de usuarios
        document.getElementById('btnSearch').addEventListener('click', function() {
            const searchValue = document.getElementById('searchUser').value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tr');

            let noResults = true;

            rows.forEach(row => {
                const name = row.children[0].textContent.toLowerCase();
                const email = row.children[1].textContent.toLowerCase();

                if (name.includes(searchValue) || email.includes(searchValue)) {
                    row.style.display = '';
                    noResults = false;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noResults) {
                document.getElementById('noResultsMessage').style.display = 'block';
            } else {
                document.getElementById('noResultsMessage').style.display = 'none';
            }
        });
        // Limpiar búsqueda y mostrar todos los usuarios
        document.getElementById('btnResetSearch').addEventListener('click', function() {
            document.getElementById('searchUser').value = '';
            document.querySelectorAll('#userTable tr').forEach(row => {
                row.style.display = '';
            });
            document.getElementById('noResultsMessage').style.display = 'none';
        });
    </script>
@endsection

@section('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para mostrar el botón de "Guardar cambios" cuando se cambia el rol -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.role-select').forEach(select => {
                select.addEventListener('change', function() {
                    const userId = this.getAttribute('data-id');
                    document.getElementById(`saveRoleChanges-${userId}`).style.display = 'block';
                });
            });
        });
    </script>
@endsection

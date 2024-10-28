<!-- resources/views/layouts/sidebar.blade.php -->

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
        <!--crear usuarios-->
        <li class="nav-item mb-3">
            <a class="nav-link text-white {{ request()->is('admin/usuarios/create') ? 'active' : '' }}" href="{{ route('admin.usuarios.create') }}">
                <i class="fas fa-user-plus"></i> Crear Usuario
            </a>
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
        <li class="nav-item mb-3">
            <a class="nav-link text-white {{ request()->is('/historial*') ? 'active' : '' }}" href="{{ route('historial.index') }}">
                <i class="fas fa-history"></i> Historial de Cambios
            </a>
        </li>
        <!-- Perfil -->
        <li class="nav-item mb-3">
            <a class="nav-link text-white {{ request()->is('/configuracion') ? 'active' : '' }}" href="{{ route('admin.config') }}">
                <i class="fas fa-user"></i> Perfil
            </a>
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

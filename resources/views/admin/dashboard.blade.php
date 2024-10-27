<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
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

    <!-- Sección de actividad reciente -->
    <div class="mt-4">
        <div class="card">
            <div class="card-header">Actividad Reciente</div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($actividadesRecientes as $actividad)
                        <li class="list-group-item">{{ $actividad['mensaje'] }} - {{ $actividad['fecha'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

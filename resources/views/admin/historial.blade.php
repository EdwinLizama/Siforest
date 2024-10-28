@extends('layouts.app')

@section('title', 'Historial de Cambios')

@section('content')
    <div class="container mt-5 pt-5"> <!-- Agregamos margin-top y padding-top -->
        <h2>Historial de Cambios</h2>

        @if($historialCambios->isEmpty())
            <div class="alert alert-info">No hay cambios registrados.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Tipo de Cambio</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historialCambios as $cambio)
                        <tr>
                            <td>{{ $cambio->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $cambio->usuario->name }}</td>
                            <td>{{ $cambio->tipo_cambio }}</td>
                            <td>{{ $cambio->descripcion_cambio }}</td>
                            <td><a href="{{ route('historial.show', $cambio->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            {{ $historialCambios->links() }}
        @endif
    </div>
@endsection

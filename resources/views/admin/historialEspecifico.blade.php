@extends('layouts.app')

@section('title', 'Detalles del Cambio')

@section('content')
    <div class="container mt-5 pt-5">
        <h2>Detalles del Cambio</h2>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                Cambio realizado el {{ $historialCambio->created_at->format('d/m/Y H:i') }} por {{ $historialCambio->usuario->name }}
            </div>
            <div class="card-body">
                <p><strong>Tipo de Cambio:</strong> {{ $historialCambio->tipo_cambio }}</p>
                <p><strong>Descripción:</strong> {{ $historialCambio->descripcion_cambio }}</p>
                
                @if($historialCambio->documento)
                    <p><strong>Documento Afectado:</strong> {{ $historialCambio->documento->nombre_documento }}</p>
                    <p><a href="{{ route('documentos.show', $historialCambio->documento->id) }}" class="btn btn-info btn-sm">Ver Documento</a></p>
                @endif
                
                @if($historialCambio->solicitud)
                    <p><strong>Solicitud Afectada:</strong> {{ $historialCambio->solicitud->nombre }}</p>
                    <p><a href="{{ route('solicitud.show', $historialCambio->solicitud->id) }}" class="btn btn-info btn-sm">Ver Solicitud</a></p>
                @endif
                
                <a href="{{ route('historial.index') }}" class="btn btn-secondary">Volver al Historial</a>
            </div>
        </div>
    </div>
@endsection


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de la Solicitud</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header {
            background-color: #303845;
            color: white;
        }
        .section-title {
            background-color: #f8f9fa;
            padding: 10px;
            margin-top: 20px;
            border-left: 4px solid #303845;
        }
        .label-bold {
            font-weight: bold;
        }
        .border-green {
            border: 2px solid #28a745;
        }
        .legend-green {
            font-size: 1.1em;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 10px;
        }
        .form-row {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Detalles de la Solicitud</h1>
        <div class="card border-green">
            <div class="card-header">
                <h5 class="card-title">Solicitud #{{ $solicitud->id }}</h5>
            </div>
            <div class="card-body">
                <!-- Sección del Expediente -->
                <fieldset class="border p-2 mb-3 border-green">
                    <legend class="w-auto legend-green">Datos del Expediente</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <span class="label-bold">Nº Expediente:</span>
                            <p>{{ $solicitud->expediente_r }}-{{ $solicitud->expediente_ano }}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="label-bold">Fecha de Solicitud:</span>
                            <p>{{ $solicitud->fecha_solicitud }}</p>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección A: Datos generales del solicitante -->
                <fieldset class="border p-2 mb-3 border-green">
                    <legend class="w-auto legend-green">A. Datos generales del solicitante</legend>
                    <div class="form-group">
                        <span class="label-bold">Nombre completo del propietario (a) o representante legal:</span>
                        <p>{{ $solicitud->nombre }}</p>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <span class="label-bold">NIT:</span>
                            <p>{{ $solicitud->nit }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">DUI:</span>
                            <p>{{ $solicitud->dui }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Emitido en:</span>
                            <p>{{ $solicitud->emitido_en }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Fecha de Emisión:</span>
                            <p>{{ $solicitud->fecha_emision }}</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <span class="label-bold">Departamento:</span>
                            <p>{{ $solicitud->departamento_solicitante }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Municipio:</span>
                            <p>{{ $solicitud->municipio_solicitante }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Cantón:</span>
                            <p>{{ $solicitud->canton }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Caserío:</span>
                            <p>{{ $solicitud->caserio }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="label-bold">Dirección particular:</span>
                        <p>{{ $solicitud->direccion }}</p>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <span class="label-bold">Teléfono fijo:</span>
                            <p>{{ $solicitud->telefono_fijo }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Celular:</span>
                            <p>{{ $solicitud->celular }}</p>
                        </div>
                        <div class="col-md-6">
                            <span class="label-bold">Correo electrónico:</span>
                            <p>{{ $solicitud->correo }}</p>
                        </div>
                    </div>
                </fieldset>

                <!-- Sección B: Detalle de árboles solicitados -->
                <fieldset class="border p-2 mb-3 border-green">
                    <legend class="w-auto legend-green">B. Detalle de árboles solicitados</legend>
                    <div class="form-row">
                        <div class="col-md-6">
                            <span class="label-bold">Especie:</span>
                            <p>{{ $solicitud->especie }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Cantidad:</span>
                            <p>{{ $solicitud->cantidad }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Total:</span>
                            <p>{{ $solicitud->total }}</p>
                        </div>
                    </div>

                    <!-- Árboles adicionales -->
                    @if($solicitud->especie_adicional1 || $solicitud->especie_adicional2 || $solicitud->especie_adicional3)
                    <div class="form-row">
                        <div class="col-md-6">
                            <span class="label-bold">Especie Adicional 1:</span>
                            <p>{{ $solicitud->especie_adicional1 }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Cantidad Adicional 1:</span>
                            <p>{{ $solicitud->cantidad_adicional1 }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Total Adicional 1:</span>
                            <p>{{ $solicitud->total_adicional1 }}</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <span class="label-bold">Especie Adicional 2:</span>
                            <p>{{ $solicitud->especie_adicional2 }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Cantidad Adicional 2:</span>
                            <p>{{ $solicitud->cantidad_adicional2 }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Total Adicional 2:</span>
                            <p>{{ $solicitud->total_adicional2 }}</p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <span class="label-bold">Especie Adicional 3:</span>
                            <p>{{ $solicitud->especie_adicional3 }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Cantidad Adicional 3:</span>
                            <p>{{ $solicitud->cantidad_adicional3 }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Total Adicional 3:</span>
                            <p>{{ $solicitud->total_adicional3 }}</p>
                        </div>
                    </div>
                    @endif
                </fieldset>

                <!-- Sección C: Ubicación de la propiedad -->
                <fieldset class="border p-2 mb-3 border-green">
                    <legend class="w-auto legend-green">C. Ubicación de la propiedad</legend>
                    <div class="form-row">
                        <div class="col-md-3">
                            <span class="label-bold">Departamento:</span>
                            <p>{{ $solicitud->departamento_propiedad }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Municipio:</span>
                            <p>{{ $solicitud->municipio_propiedad }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Cantón:</span>
                            <p>{{ $solicitud->canton_prop }}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="label-bold">Caserío:</span>
                            <p>{{ $solicitud->caserio_prop }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="label-bold">Acceso:</span>
                        <p>{{ $solicitud->acceso }}</p>
                    </div>
                </fieldset>

                <!-- Sección D: Justificación del aprovechamiento -->
                <fieldset class="border p-2 mb-3 border-green">
                    <legend class="w-auto legend-green">D. Justificación del aprovechamiento</legend>
                    <p>{{ $solicitud->justificacion }}</p>
                </fieldset>
            </div>
        </div>
        <a href="{{ route('solicitudes') }}" class="btn btn-primary mt-3">Volver a la lista</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

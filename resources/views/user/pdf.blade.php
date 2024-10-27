<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud PDF</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #303845;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            background: #303845;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .field {
            margin-bottom: 8px;
            font-size: 14px;
        }
        .field span {
            display: inline-block;
            width: 200px;
            font-weight: bold;
        }
        .field-value {
            border-bottom: 1px solid #dee2e6;
            display: inline-block;
            width: calc(100% - 210px);
            padding-bottom: 3px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        .table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detalles de la Solicitud</h1>
        </div>

        <!-- Sección del Expediente -->
        <div class="section">
            <div class="section-title">Datos del Expediente</div>
            <div class="field">
                <span>Nº Expediente:</span> <div class="field-value">{{ $solicitud->expediente_r }}-{{ $solicitud->expediente_ano }}</div>
            </div>
            <div class="field">
                <span>Fecha de Solicitud:</span> <div class="field-value">{{ $solicitud->fecha_solicitud }}</div>
            </div>
            <div class="field">
                <span>Nombre del Solicitante:</span> <div class="field-value">{{ $solicitud->nombre }}</div>
            </div>
        </div>

        <!-- Sección A: Datos generales del solicitante -->
        <div class="section">
            <div class="section-title">A. Datos generales del solicitante</div>
            <div class="field">
                <span>NIT:</span> <div class="field-value">{{ $solicitud->nit }}</div>
            </div>
            <div class="field">
                <span>DUI:</span> <div class="field-value">{{ $solicitud->dui }}</div>
            </div>
            <div class="field">
                <span>Emitido en:</span> <div class="field-value">{{ $solicitud->emitido_en }}</div>
            </div>
            <div class="field">
                <span>Fecha de Emisión:</span> <div class="field-value">{{ $solicitud->fecha_emision }}</div>
            </div>
            <div class="field">
                <span>Departamento:</span> <div class="field-value">{{ $solicitud->departamento_solicitante }}</div>
            </div>
            <div class="field">
                <span>Municipio:</span> <div class="field-value">{{ $solicitud->municipio_solicitante }}</div>
            </div>
            <div class="field">
                <span>Cantón:</span> <div class="field-value">{{ $solicitud->canton }}</div>
            </div>
            <div class="field">
                <span>Caserío:</span> <div class="field-value">{{ $solicitud->caserio }}</div>
            </div>
            <div class="field">
                <span>Dirección particular:</span> <div class="field-value">{{ $solicitud->direccion }}</div>
            </div>
            <div class="field">
                <span>Teléfono fijo:</span> <div class="field-value">{{ $solicitud->telefono_fijo }}</div>
            </div>
            <div class="field">
                <span>Celular:</span> <div class="field-value">{{ $solicitud->celular }}</div>
            </div>
            <div class="field">
                <span>Correo electrónico:</span> <div class="field-value">{{ $solicitud->correo }}</div>
            </div>
        </div>

        <!-- Sección B: Detalle de árboles solicitados -->
        <div class="section">
            <div class="section-title">B. Detalle de árboles solicitados</div>
            <div class="field">
                <span>Especie:</span> <div class="field-value">{{ $solicitud->especie }}</div>
            </div>
            <div class="field">
                <span>Cantidad:</span> <div class="field-value">{{ $solicitud->cantidad }}</div>
            </div>
            <div class="field">
                <span>Total:</span> <div class="field-value">{{ $solicitud->total }}</div>
            </div>

            <!-- Árboles adicionales -->
            @if($solicitud->especie_adicional1 || $solicitud->especie_adicional2 || $solicitud->especie_adicional3)
                <div class="field">
                    <span>Especie Adicional 1:</span> <div class="field-value">{{ $solicitud->especie_adicional1 }}</div>
                </div>
                <div class="field">
                    <span>Cantidad Adicional 1:</span> <div class="field-value">{{ $solicitud->cantidad_adicional1 }}</div>
                </div>
                <div class="field">
                    <span>Total Adicional 1:</span> <div class="field-value">{{ $solicitud->total_adicional1 }}</div>
                </div>
                <div class="field">
                    <span>Especie Adicional 2:</span> <div class="field-value">{{ $solicitud->especie_adicional2 }}</div>
                </div>
                <div class="field">
                    <span>Cantidad Adicional 2:</span> <div class="field-value">{{ $solicitud->cantidad_adicional2 }}</div>
                </div>
                <div class="field">
                    <span>Total Adicional 2:</span> <div class="field-value">{{ $solicitud->total_adicional2 }}</div>
                </div>
                <div class="field">
                    <span>Especie Adicional 3:</span> <div class="field-value">{{ $solicitud->especie_adicional3 }}</div>
                </div>
                <div class="field">
                    <span>Cantidad Adicional 3:</span> <div class="field-value">{{ $solicitud->cantidad_adicional3 }}</div>
                </div>
                <div class="field">
                    <span>Total Adicional 3:</span> <div class="field-value">{{ $solicitud->total_adicional3 }}</div>
                </div>
            @endif
        </div>

        <!-- Sección C: Ubicación de la propiedad -->
        <div class="section">
            <div class="section-title">C. Ubicación de la propiedad</div>
            <div class="field">
                <span>Departamento:</span> <div class="field-value">{{ $solicitud->departamento_propiedad }}</div>
            </div>
            <div class="field">
                <span>Municipio:</span> <div class="field-value">{{ $solicitud->municipio_propiedad }}</div>
            </div>
            <div class="field">
                <span>Cantón:</span> <div class="field-value">{{ $solicitud->canton_prop }}</div>
            </div>
            <div class="field">
                <span>Caserío:</span> <div class="field-value">{{ $solicitud->caserio_prop }}</div>
            </div>
            <div class="field">
                <span>Acceso:</span> <div class="field-value">{{ $solicitud->acceso }}</div>
            </div>
        </div>

        <!-- Sección D: Justificación del aprovechamiento -->
        <div class="section">
            <div class="section-title">D. Justificación del aprovechamiento</div>
            <p>{{ $solicitud->justificacion }}</p>
        </div>
    </div>
</body>
</html>

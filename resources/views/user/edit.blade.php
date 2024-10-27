<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card-header {
            background-color: #303845;
            color: white;
        }
        .fieldset {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .fieldset legend {
            font-size: 1.2em;
            font-weight: bold;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>Editar Solicitud</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('solicitud.update', $solicitud->id) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="mb-3">
                        <label for="expediente_r" class="form-label">Nº Expediente (R)</label>
                        <input type="text" class="form-control" id="expediente_r" name="expediente_r" value="{{ $solicitud->expediente_r }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="expediente_ano" class="form-label">Año Expediente</label>
                        <input type="text" class="form-control" id="expediente_ano" name="expediente_ano" value="{{ $solicitud->expediente_ano }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_solicitud" class="form-label">Fecha de Solicitud</label>
                        <input type="date" class="form-control" id="fecha_solicitud" name="fecha_solicitud" value="{{ $solicitud->fecha_solicitud }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Solicitante</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $solicitud->nombre }}" required>
                    </div>

                    <fieldset class="fieldset">
                        <legend>A. Datos generales del solicitante:</legend>

                        <div class="mb-3">
                            <label for="nit" class="form-label">NIT</label>
                            <input type="text" class="form-control" id="nit" name="nit" value="{{ $solicitud->nit }}">
                        </div>

                        <div class="mb-3">
                            <label for="dui" class="form-label">DUI</label>
                            <input type="text" class="form-control" id="dui" name="dui" value="{{ $solicitud->dui }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="emitido_en" class="form-label">Emitido en</label>
                            <input type="text" class="form-control" id="emitido_en" name="emitido_en" value="{{ $solicitud->emitido_en }}">
                        </div>

                        <div class="mb-3">
                            <label for="fecha_emision" class="form-label">Fecha de Emisión</label>
                            <input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="{{ $solicitud->fecha_emision }}">
                        </div>

                        <div class="mb-3">
                            <label for="departamento_solicitante" class="form-label">Departamento</label>
                            <input type="text" class="form-control" id="departamento_solicitante" name="departamento_solicitante" value="{{ $solicitud->departamento_solicitante }}">
                        </div>

                        <div class="mb-3">
                            <label for="municipio_solicitante" class="form-label">Municipio</label>
                            <input type="text" class="form-control" id="municipio_solicitante" name="municipio_solicitante" value="{{ $solicitud->municipio_solicitante }}">
                        </div>

                        <div class="mb-3">
                            <label for="canton" class="form-label">Cantón</label>
                            <input type="text" class="form-control" id="canton" name="canton" value="{{ $solicitud->canton }}">
                        </div>

                        <div class="mb-3">
                            <label for="caserio" class="form-label">Caserío</label>
                            <input type="text" class="form-control" id="caserio" name="caserio" value="{{ $solicitud->caserio }}">
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección particular</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $solicitud->direccion }}">
                        </div>

                        <div class="mb-3">
                            <label for="telefono_fijo" class="form-label">Teléfono fijo</label>
                            <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" value="{{ $solicitud->telefono_fijo }}">
                        </div>

                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celular" name="celular" value="{{ $solicitud->celular }}">
                        </div>

                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $solicitud->correo }}">
                        </div>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend>B. Detalle de árboles solicitados:</legend>

                        <div class="mb-3">
                            <label for="especie" class="form-label">Especie</label>
                            <input type="text" class="form-control" id="especie" name="especie" value="{{ $solicitud->especie }}">
                        </div>

                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $solicitud->cantidad }}">
                        </div>

                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" id="total" name="total" value="{{ $solicitud->total }}">
                        </div>

                        <div class="mb-3">
                            <label for="especie_adicional1" class="form-label">Especie Adicional 1</label>
                            <input type="text" class="form-control" id="especie_adicional1" name="especie_adicional1" value="{{ $solicitud->especie_adicional1 }}">
                        </div>

                        <div class="mb-3">
                            <label for="cantidad_adicional1" class="form-label">Cantidad Adicional 1</label>
                            <input type="number" class="form-control" id="cantidad_adicional1" name="cantidad_adicional1" value="{{ $solicitud->cantidad_adicional1 }}">
                        </div>

                        <div class="mb-3">
                            <label for="total_adicional1" class="form-label">Total Adicional 1</label>
                            <input type="text" class="form-control" id="total_adicional1" name="total_adicional1" value="{{ $solicitud->total_adicional1 }}">
                        </div>

                        <div class="mb-3">
                            <label for="especie_adicional2" class="form-label">Especie Adicional 2</label>
                            <input type="text" class="form-control" id="especie_adicional2" name="especie_adicional2" value="{{ $solicitud->especie_adicional2 }}">
                        </div>

                        <div class="mb-3">
                            <label for="cantidad_adicional2" class="form-label">Cantidad Adicional 2</label>
                            <input type="number" class="form-control" id="cantidad_adicional2" name="cantidad_adicional2" value="{{ $solicitud->cantidad_adicional2 }}">
                        </div>

                        <div class="mb-3">
                            <label for="total_adicional2" class="form-label">Total Adicional 2</label>
                            <input type="text" class="form-control" id="total_adicional2" name="total_adicional2" value="{{ $solicitud->total_adicional2 }}">
                        </div>

                        <div class="mb-3">
                            <label for="especie_adicional3" class="form-label">Especie Adicional 3</label>
                            <input type="text" class="form-control" id="especie_adicional3" name="especie_adicional3" value="{{ $solicitud->especie_adicional3 }}">
                        </div>

                        <div class="mb-3">
                            <label for="cantidad_adicional3" class="form-label">Cantidad Adicional 3</label>
                            <input type="number" class="form-control" id="cantidad_adicional3" name="cantidad_adicional3" value="{{ $solicitud->cantidad_adicional3 }}">
                        </div>

                        <div class="mb-3">
                            <label for="total_adicional3" class="form-label">Total Adicional 3</label>
                            <input type="text" class="form-control" id="total_adicional3" name="total_adicional3" value="{{ $solicitud->total_adicional3 }}">
                        </div>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend>C. Ubicación de la propiedad:</legend>

                        <div class="mb-3">
                            <label for="departamento_propiedad" class="form-label">Departamento</label>
                            <input type="text" class="form-control" id="departamento_propiedad" name="departamento_propiedad" value="{{ $solicitud->departamento_propiedad }}">
                        </div>

                        <div class="mb-3">
                            <label for="municipio_propiedad" class="form-label">Municipio</label>
                            <input type="text" class="form-control" id="municipio_propiedad" name="municipio_propiedad" value="{{ $solicitud->municipio_propiedad }}">
                        </div>

                        <div class="mb-3">
                            <label for="canton_prop" class="form-label">Cantón</label>
                            <input type="text" class="form-control" id="canton_prop" name="canton_prop" value="{{ $solicitud->canton_prop }}">
                        </div>

                        <div class="mb-3">
                            <label for="caserio_prop" class="form-label">Caserío</label>
                            <input type="text" class="form-control" id="caserio_prop" name="caserio_prop" value="{{ $solicitud->caserio_prop }}">
                        </div>

                        <div class="mb-3">
                            <label for="acceso" class="form-label">Acceso</label>
                            <input type="text" class="form-control" id="acceso" name="acceso" value="{{ $solicitud->acceso }}">
                        </div>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend>D. Justificación del aprovechamiento:</legend>

                        <div class="mb-3">
                            <label for="justificacion" class="form-label">Justificación</label>
                            <textarea class="form-control" id="justificacion" name="justificacion">{{ $solicitud->justificacion }}</textarea>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
